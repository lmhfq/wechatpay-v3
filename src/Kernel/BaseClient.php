<?php

namespace Lmh\WeChatPayV3\Kernel;

use Closure;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7;
use Illuminate\Support\Arr;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Lmh\WeChatPayV3\Kernel\Exceptions\SignInvalidException;
use Lmh\WeChatPayV3\Kernel\Traits\HasHttpRequests;
use Lmh\WeChatPayV3\Kernel\Traits\ResponseCastable;
use Lmh\WeChatPayV3\Kernel\Traits\RestfulMethods;
use Lmh\WeChatPayV3\Kernel\Traits\SignatureGenerator;
use Lmh\WeChatPayV3\Kernel\Utils\RsaUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    use RestfulMethods, ResponseCastable, SignatureGenerator, HasHttpRequests {
        request as performRequest;
    }

    protected $baseUri = 'https://api.mch.weixin.qq.com';

    protected $app;

    protected $accessToken;

    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * verify the response with certificate
     *
     * @return Closure
     */
    protected function certificateMiddleware(): Closure
    {
        return Middleware::tap(null, function (RequestInterface $request, $options, ResponseInterface $response) {
        });
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    protected function request(string $method, string $url, array $options = []): array
    {
        try {
            $response = $this->requestRaw($method, $url, $options);
        } catch (RequestException $exception) {
            if ($exception->getResponse() != null) {
                $result = $this->castResponse($exception->getResponse());
            } else {
                $result['message'] = $exception->getMessage();
            }
            $message = $result['message'] ?? $exception->getMessage();
            if (($pos = mb_strpos($message, '映射到字段')) !== false) {
                $message = mb_substr($message, $pos + 5);
            } elseif (($pos = mb_strpos($message, '映射到值字段')) !== false) {
                $message = mb_substr($message, $pos + 6);
            }
            throw new ResultException($message, $result['code'] ?? '');
        }
        return $this->castResponse($response);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function requestRaw(string $method, string $url, array $options = []): ResponseInterface
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddleware();
            if ($url !== '/v3/merchant/media/upload') {
                $this->pushMiddleware($this->logMiddleware(), 'log');
            }
        }
        return $this->performRequest($url, $method, $options);
    }

    protected function registerHttpMiddleware()
    {
        // sensitive param
        $this->pushMiddleware($this->sensitiveParamMiddleware(), 'sensitive_param');

        // auth
        $this->pushMiddleware($this->authMiddleware(), 'auth');

        // verify sign
        $this->pushMiddleware($this->verifySignMiddleware(), 'verify_sign');

        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');
    }

    /**
     * Encrypt/Decrypt sensitive param
     *
     * @return Closure
     */
    protected function sensitiveParamMiddleware()
    {
        return function (callable $handler) {
            return function (
                RequestInterface $request,
                array            $options
            ) use ($handler) {
                $encodeParams = Arr::get($options, 'encode_params', []);
                if (!empty($encodeParams)) {
                    $body = $request->getBody()->getContents();
                    $request->getBody()->rewind();
                    $params = json_decode($body, true);
                    $certificate = (new Certificate($this->app));
                    $serialNo = $certificate->getAvailableSerialNo();
                    if (!empty($params)) {
                        foreach ($encodeParams as $encodeParam) {
                            $value = Arr::get($params, $encodeParam);
                            if (!is_null($value)) {
                                $encrypted = RsaUtil::publicEncrypt(
                                    $value,
                                    $certificate->getPublicKey($serialNo)
                                );
                                Arr::set($params, $encodeParam, $encrypted);
                            }
                        }
                        $request = $request->withBody(Psr7\stream_for(json_encode($params)));
                    }
                    $request = $request->withHeader('WeChatPay-Serial', $serialNo);
                }

                /** @var Promise $promise */
                $promise = $handler($request, $options);
                return $promise->then(
                    function (ResponseInterface $response) use ($options) {
                        $decodeParams = Arr::get($options, 'decode_params', []);
                        if (!empty($decodeParams)) {
                            $response->getBody()->rewind();
                            $body = $response->getBody()->getContents();
                            $params = json_decode($body, true);
                            if (!empty($params)) {
                                foreach ($decodeParams as $decodeParam) {
                                    $value = Arr::get($params, $decodeParam);
                                    if (!is_null($value)) {
                                        $decryptedValue = RsaUtil::privateDecrypt(
                                            $value,
                                            $this->app->config->get('private_key')
                                        );
                                        Arr::set($params, $decodeParam, $decryptedValue);
                                    }
                                }
                                $response = $response->withBody(Psr7\stream_for(json_encode($params)));
                            }
                        }
                        return $response;
                    }
                );
            };
        };
    }

    /**
     * Attache auth to the request header.
     *
     * @return Closure
     */
    protected function authMiddleware(): Closure
    {
        return function (callable $handler) {
            return function (
                RequestInterface $request,
                array            $options
            ) use ($handler) {
                $request = $request->withHeader('Accept', 'application/json');
                $auth = $this->authHeader($request, $options);
                $request = $request->withHeader('Authorization', $auth);

                return $handler($request, $options);
            };
        };
    }

    /**
     * Attache auth to the request header.
     *
     * @return Closure
     */
    protected function verifySignMiddleware(): Closure
    {
        return function (callable $handler) {
            return function (
                RequestInterface $request,
                array            $options
            ) use ($handler) {
                /** @var Promise $promise */
                $promise = $handler($request, $options);

                return $promise->then(
                    function (ResponseInterface $response) {
                        if (!$this->isResponseSignValid($response)) {
                            throw new SignInvalidException('响应结果签名验证失败');
                        }
                        return $response;
                    }
                );
            };
        };
    }

    /**
     * Log the request.
     *
     * @return Closure
     */
    protected function logMiddleware(): Closure
    {
        $log = $this->app['config']->get('log');

        if (isset($log['logMiddleware'])) {
            return $log['logMiddleware'];
        }
        $formatter = new MessageFormatter($this->app['config']['http']['log_template'] ?? MessageFormatter::DEBUG);
        return Middleware::log($this->app['logger'], $formatter);
    }

    /**
     * Return retry middleware.
     *
     * @return Closure
     */
    protected function retryMiddleware(): Closure
    {
        return Middleware::retry(function (
            $retries,
            RequestInterface $request,
            ResponseInterface $response = null
        ) {
            // Limit the number of retries to 2
            if ($retries < $this->app['config']->get('http.max_retries', 1) && $response && $body = $response->getBody()) {
                // Retry on server errors
                $response = json_decode($body, true);

                if (!empty($response['errcode']) && in_array(abs($response['errcode']), [40001, 40014, 42001], true)) {
                    $this->accessToken->refresh();
                    $this->app['logger']->debug('Retrying with refreshed access token.');

                    return true;
                }
            }

            return false;
        }, function () {
            return abs($this->app['config']->get('http.retry_delay', 500));
        });
    }
}
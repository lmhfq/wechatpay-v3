<?php

namespace Lmh\WeChatPayV3\Kernel;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Lmh\WeChatPayV3\Kernel\Exceptions\DecryptException;
use Lmh\WeChatPayV3\Kernel\Exceptions\InvalidArgumentException;
use Lmh\WeChatPayV3\Kernel\Exceptions\RuntimeException;
use Lmh\WeChatPayV3\Kernel\Exceptions\SignInvalidException;
use Lmh\WeChatPayV3\Kernel\Utils\AesUtil;
use Lmh\WeChatPayV3\Service\Certificate\Client;
use Pimple\Container;
use Redis;
use Throwable;

class Certificate
{
    const CERTIFICATE_CACHE_PREFIX = 'openpay-wechatpay-v3.kernel.certificate.';
    const SERIAL_NUMBER_CACHE = 'openpay-wechatpay-v3.kernel.serial-no.';

    /**
     * @var Container
     */
    protected $app;

    /**
     * Certificate constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed|string
     * @throws DecryptException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws SignInvalidException
     * @throws GuzzleException
     * @throws Throwable
     */
    public function getAvailableSerialNo()
    {
        $ttl = 12 * 3600;
        /**
         * @var Redis $cache
         */
        $client = $this->app->config->get('redisClient');
        $mchId = $this->app->config['mch_id'];
        if ($client != null && $client instanceof Redis) {
            $serialNo = $client->get($this->getSerialNoCacheKey($mchId) . $mchId);
            if ($serialNo) {
                return $serialNo;
            }
        }
        /** @var Client $certificateClient */
        $certificateClient = $this->app['certificate'];
        $certificates = collect(Arr::get($certificateClient->all(), 'data'));
        if ($certificates->isEmpty()) {
            throw new SignInvalidException('没有可用的平台证书列表');
        }
        $certificate = $certificates->reduce(function ($carry, $certificate) {
            if (empty($carryExpireTime = Arr::get($carry, 'expire_time'))) {
                return $certificate;
            }
            $carryExpireTime = Carbon::createFromTimeString($carryExpireTime);
            $expireTime = Carbon::createFromTimeString(Arr::get($certificate, 'expire_time'));

            return $carryExpireTime->gt($expireTime) ? $carryExpireTime : $expireTime;
        });
        if (!$certificate) {
            throw new SignInvalidException('没有可用的平台证书');
        }
        $serialNo = Arr::get($certificate, 'serial_no');
        $aesKey = $this->app['config']->get('aes_key');
        $publicKey = $this->decryptCertificate(Arr::get($certificate, 'encrypt_certificate'), $aesKey);
        if ($client != null && $client instanceof Redis) {
            $client->set($this->getSerialNoCacheKey($mchId), $serialNo, $ttl);
            $client->set($this->getPublicKeyCacheKey($serialNo), $publicKey, $ttl);
        }
        return $serialNo;
    }

    /**
     * @param $mchId
     * @return string
     */
    private function getSerialNoCacheKey($mchId)
    {
        return self::SERIAL_NUMBER_CACHE . $mchId;
    }

    /**
     * @param $encryptCertificate
     * @param $aesKey
     * @return bool|string
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws DecryptException
     */
    private function decryptCertificate($encryptCertificate, $aesKey)
    {
        $associatedData = Arr::get($encryptCertificate, 'associated_data');
        $nonceStr = Arr::get($encryptCertificate, 'nonce');
        $cipherText = Arr::get($encryptCertificate, 'ciphertext');
        $publicKey = (new AesUtil($aesKey))->decryptAES256GCM($associatedData, $nonceStr, $cipherText);
        if (!$publicKey) {
            throw new DecryptException('解密证书失败');
        }

        return $publicKey;
    }

    /**
     * @param $serialNo
     * @return string
     */
    private function getPublicKeyCacheKey($serialNo)
    {
        return self::CERTIFICATE_CACHE_PREFIX . $serialNo;
    }

    /**
     * @param $serialNo
     * @return mixed
     * @throws SignInvalidException
     */
    public function getPublicKey($serialNo)
    {
        $ttl = 12 * 3600;
        /**
         * @var Redis $cache
         */
        $client = $this->app->config->get('redisClient');
        $mchId = $this->app->config['mch_id'];
        if ($client != null && $client instanceof Redis) {
            $publicKey = $client->get($this->getPublicKeyCacheKey($serialNo));
            if ($publicKey) {
                return $publicKey;
            }
        }
        /** @var Client $certificateClient */
        $certificateClient = $this->app['certificate'];
        $certificates = collect(Arr::get($certificateClient->all(), 'data'));
        $certificate = $certificates->firstWhere('serial_no', '=', $serialNo);
        if (empty($certificate)) {
            throw new SignInvalidException('证书序列号不存在于可用的证书列表中');
        }
        $aesKey = $this->app->config->get('aes_key');
        $publicKey = $this->decryptCertificate(Arr::get($certificate, 'encrypt_certificate'), $aesKey);
        if ($client != null && $client instanceof Redis) {
            $client->set($this->getSerialNoCacheKey($mchId), $serialNo, $ttl);
            $client->set($this->getPublicKeyCacheKey($serialNo), $publicKey, $ttl);
        }
        return $publicKey;
    }
}
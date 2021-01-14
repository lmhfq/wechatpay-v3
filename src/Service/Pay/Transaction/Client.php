<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/1/14
 * Time: 下午4:23
 */

namespace Lmh\WeChatPayV3\Service\Pay\Transaction;


use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    public static function className()
    {
        return 'pay/transactions';
    }

    /**
     * @param array $params
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function jsapi(array $params, array $options = []): ResponseInterface
    {
        $url = self::classUrl() . 'jsapi';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function h5(array $params, array $options = []): ResponseInterface
    {
        $url = self::classUrl() . 'h5';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }
}
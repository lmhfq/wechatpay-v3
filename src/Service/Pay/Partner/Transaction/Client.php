<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/1/14
 * Time: 下午4:22
 */

namespace Lmh\WeChatPayV3\Service\Pay\Partner\Transaction;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class Client extends BaseClient
{
    public static function className()
    {
        return 'pay/partner/transactions';
    }

    /**
     * @param array $params
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function jsapi(array $params, array $options = [])
    {
        $url = self::classUrl() . '/jsapi';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function h5(array $params, array $options = [])
    {
        $url = self::classUrl() . '/h5';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }


    /**
     * @param $appId
     * @param $prepayId
     * @param $subMerchantId
     * @param null $timestamp
     * @return array
     */
    public function appPayInfo($appId, $prepayId, $subMerchantId, $timestamp = null)
    {
        $payload = [
            'appId' => $appId,
            'timeStamp' => $timestamp ? strval($timestamp) : strval(time()),
            'nonceStr' => Str::random(32),
            'prepayId' => $prepayId,
        ];
        $payload += [
            'partnerId' => $subMerchantId,
            'packageValue' => 'Sign=WXPay',
            'paySign' => $this->sign($payload),
        ];

        return $payload;
    }

    /**
     * @param $appId
     * @param $prepayId
     * @param null $timestamp
     * @return array
     */
    public function jsApiPayInfo($appId, $prepayId, $timestamp = null): array
    {
        $payload = [
            'appId' => $appId,
            'timeStamp' => $timestamp ? strval($timestamp) : strval(time()),
            'nonceStr' => Str::random(32),
            'package' => 'prepay_id=' . $prepayId,
        ];
        $payload += [
            'signType' => 'RSA',
            'paySign' => $this->sign($payload),
        ];
        return $payload;
    }
}
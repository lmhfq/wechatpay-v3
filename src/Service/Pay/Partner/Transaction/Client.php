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
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Lmh\WeChatPayV3\Kernel\Utils\StrUtil;
use Throwable;

class Client extends BaseClient
{
    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function jsapi(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/jsapi';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     * @throws GuzzleException
     * @throws Throwable
     */
    public function h5(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/h5';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function native(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/native';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
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
            'nonceStr' => StrUtil::random(32),
            'package' => 'prepay_id=' . $prepayId,
        ];
        $payload += [
            'signType' => 'RSA',
            'paySign' => $this->sign($payload),
        ];
        return $payload;
    }

    /**
     * @param $appId
     * @param $prepayId
     * @param $subMchId
     * @param null $timestamp
     * @return array
     */
    public function appPayInfo($appId, $prepayId, $subMchId, $timestamp = null): array
    {
        $payload = [
            'appId' => $appId,
            'timeStamp' => $timestamp ? strval($timestamp) : strval(time()),
            'nonceStr' => StrUtil::random(32),
            'prepayId' => $prepayId,
        ];
        $payload += [
            'partnerId' => $subMchId,
            'packageValue' => 'Sign=WXPay',
            'paySign' => $this->sign($payload),
        ];

        return $payload;
    }

    /**
     * @param string $outTradeNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @throws Throwable
     */
    public function queryByOutTradeNo(string $outTradeNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-trade-no/' . $outTradeNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
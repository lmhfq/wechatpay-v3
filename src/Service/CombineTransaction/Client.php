<?php

namespace Lmh\WeChatPayV3\Service\CombineTransaction;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Lmh\WeChatPayV3\Kernel\Utils\StrUtil;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @return string
     */
    public static function className(): string
    {
        return 'combine-transactions';
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function app(array $params, array $options = []): array
    {
        return $this->createByChannel('app', $params, $options);
    }

    /**
     * @param string $channel 值仅可为 app 或 jsapi
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function createByChannel(string $channel, array $params, array $options = []): array
    {
        $url = self::classUrl() . '/' . $channel;
        $opts = $options + ['json' => $params];

        return $this->request('POST', $url, $opts);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function jsapi(array $params, array $options = []): array
    {
        return $this->createByChannel('jsapi', $params, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function h5(array $params, array $options = []): array
    {
        return $this->createByChannel('h5', $params, $options);
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
        return $this->createByChannel('native', $params, $options);
    }

    /**
     * @param string $outTradeNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByOutTradeNo(string $outTradeNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-trade-no/' . $outTradeNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $outTradeNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function closeByOutTradeNo(string $outTradeNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-trade-no/' . $outTradeNo . '/close';
        $opts = $options + ['query' => $query];

        return $this->request('POST', $url, $opts);
    }

    /**
     * @param $appId
     * @param $timestamp
     * @param $prepayId
     * @return array
     */
    public function appPayInfo($appId, $timestamp, $prepayId, $subMerchantId): array
    {
        $payload = [
            'appId' => $appId,
            'timeStamp' => strval($timestamp),
            'nonceStr' => StrUtil::random(32),
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
     * @param $timestamp
     * @param $prepayId
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
}

<?php

namespace Lmh\WeChatPayV3\Service\Applyment4Sub\Applyment;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

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
        return 'applyment4sub/applyment';
    }

    /**
     * 提交申请单
     * @see https://pay.weixin.qq.com/wiki/doc/apiv3_partner/apis/chapter11_1_1.shtml
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/';
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * 查询申请单状态API
     * @see https://pay.weixin.qq.com/wiki/doc/apiv3_partner/apis/chapter11_1_2.shtml
     * @param string $businessCode
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function queryByBusinessCode(string $businessCode, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/business_code/' . $businessCode;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}

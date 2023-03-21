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
     * 查询申请单状态API
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

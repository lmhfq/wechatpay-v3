<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\Withdraw;

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
        return 'ecommerce/fund/withdraw';
    }

    /**
     * 二级商户查询预约提现状态
     * @param string $id
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByWithdrawId(string $id, $query = null, array $options = []): array
    {
        return parent::retrieve($id, $query, $options);
    }

    /**
     * 二级商户查询预约提现状态
     * @param string $outTradeNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByOutTradeNo(string $outTradeNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-request-no/' . $outTradeNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }


    /**
     * 二级商户预约提现
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        return parent::create($params, $options);
    }
}

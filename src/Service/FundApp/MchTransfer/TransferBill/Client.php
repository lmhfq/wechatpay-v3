<?php

namespace Lmh\WeChatPayV3\Service\FundApp\MchTransfer\TransferBill;

use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    public static function className(): string
    {
        return 'fund-app/mch-transfer/transfer-bills';
    }

    public function create(array $params, array $options = []): array
    {
        $params['appid'] = $this->app['config']->app_id;
        return parent::create($params, $options);
    }

    /**
     * 微信单号查询转账单
     * @param string $transferBillNo
     * @param null $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function queryByBillNo(string $transferBillNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/transfer-bill-no/' . $transferBillNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * 商户单号查询转账单
     * @param string $outBillNo
     * @param string $outDetailNo
     * @param null $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function queryByOutBillNo(string $outBillNo, string $outDetailNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-bill-no/' . $outBillNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
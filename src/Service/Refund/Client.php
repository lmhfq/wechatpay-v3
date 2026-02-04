<?php

namespace Lmh\WeChatPayV3\Service\Refund;

use Lmh\WeChatPayV3\Kernel\BaseClient;

class Client extends BaseClient
{
    public static function className(): string
    {
        return 'refund/domestic/refunds';
    }

    /**
     * 申请退款
     * @param array $params
     * @param array $options
     * @return array
     */
    public function refund(array $params, array $options = []): array
    {
        $url = self::classUrl();
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * @param string $refundId
     * @param array $params
     * @param array $options
     * @return array
     */
    public function abnormalRefund(string $refundId, array $params, array $options = []): array
    {
        $url = self::instanceUrl($refundId) . '/apply-abnormal-refund';
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * @param string $outRefundNo
     * @param $query
     * @param array $options
     * @return array
     */
    public function query(string $outRefundNo ,$query = null, array $options = []): array
    {
        return parent::retrieve($outRefundNo, $query, $options);
    }
}
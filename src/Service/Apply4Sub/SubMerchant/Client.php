<?php

namespace Lmh\WeChatPayV3\Service\Apply4Sub\SubMerchant;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 *
 */
class Client extends BaseClient
{
    /**
     * 查询结算账户
     * @param string $subMchId
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function retrieveSettlement(string $subMchId, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/' . $subMchId . '/settlement';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * 修改结算账户
     * @param string $subMchId
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function modifySettlement(string $subMchId, array $params, array $options = []): array
    {
        $url = self::classUrl() . '/' . $subMchId . '/modify-settlement';
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * 查询结算账户修改申请状态
     * @param string $subMchId
     * @param string $applicationNo
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function retrieveSettlementResult(string $subMchId, string $applicationNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/' . $subMchId . '/application' . $applicationNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}

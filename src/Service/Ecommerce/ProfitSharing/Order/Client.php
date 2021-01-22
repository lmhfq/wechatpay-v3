<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\Order;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function query(array $query = null, array $options = [])
    {
        $url = self::classUrl();
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * 查询订单剩余待分金额
     * @param array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function amount(string $transactionId, array $query = null, array $options = [])
    {
        $url = self::classUrl() . '/' . $transactionId . '/amounts';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        return parent::create($params, $options);
    }
}

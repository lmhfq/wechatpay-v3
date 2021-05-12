<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Refund;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/apply';
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * @param string $outRefundNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByOutRefundNo(string $outRefundNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-refund-no/' . $outRefundNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $id
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByRefundId(string $id, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/id/' . $id;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}

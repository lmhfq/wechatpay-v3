<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Refund;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

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
     * @throws Throwable
     */
    public function create(array $params, array $options = [])
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
     * @throws Throwable
     */
    public function queryByOutRefundNumber(string $outRefundNo, $query = null, array $options = [])
    {
        $url = self::classUrl() . '/out-refund-no/' . $outRefundNo;
        $opts = $options + ['query' => $query];

        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $id
     * @param string|array|null $query
     * @param array $options
     * @throws ResultException
     * @throws GuzzleException
     * @throws Throwable
     */
    public function queryByRefundId(string $id, $query = null, array $options = [])
    {
        $url = self::classUrl() . '/id/' . $id;
        $opts = $options + ['query' => $query];

        return $this->request('GET', $url, $opts);
    }
}

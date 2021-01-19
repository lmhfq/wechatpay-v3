<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\Withdraw;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    public static function className()
    {
        return 'ecommerce/fund/withdraw';
    }

    /**
     * @param string $id
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws Throwable
     */
    public function retrieve(string $id, $query = null, array $options = []): ResponseInterface
    {
        return parent::retrieve($id, $query, $options);
    }

    /**
     * @param string $outTradeNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @throws Throwable
     */
    public function queryByOutTradeNo(string $outTradeNo, $query = null, array $options = [])
    {
        $url = self::classUrl() . '/out-request-no/' . $outTradeNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws Throwable
     */
    public function create(array $params, array $options = [])
    {
        return parent::create($params, $options);
    }
}

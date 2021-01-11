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
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function retrieve(string $id, $query = null, array $options = [])
    {
        return parent::retrieve($id, $query, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function create(array $params, array $options = [])
    {
        return parent::create($params, $options);
    }
}

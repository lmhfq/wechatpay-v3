<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\Order;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param array|null $query
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function retrieveByOrder(array $query = null, array $options = []): ResponseInterface
    {
        $url = self::classUrl();
        $opts = $options + ['query' => $query];

        return $this->request('GET', $url, $opts);
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

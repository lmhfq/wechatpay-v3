<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\Order;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Throwable;

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
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function create(array $params, array $options = [])
    {
        return parent::create($params, $options);
    }
}

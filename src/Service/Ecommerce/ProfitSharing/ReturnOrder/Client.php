<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\ReturnOrder;

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
        return 'ecommerce/profitsharing/returnorders';
    }

    /**
     * @param null $query
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function retrieveByOrder($query = null, array $options = [])
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
     * @throws Throwable
     */
    public function create(array $params, array $options = []): array
    {
        return parent::create($params, $options);
    }
}

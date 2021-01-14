<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\Balance;

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
        return 'ecommerce/fund/balance';
    }

    /**
     * @param string $subMerchantId
     * @param string|array|null $query
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    protected function retrieve(string $subMerchantId, $query = null, array $options = []): ResponseInterface
    {
        return parent::retrieve($subMerchantId, $query, $options);
    }
}

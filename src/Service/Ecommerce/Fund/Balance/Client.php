<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\Balance;

use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @return string
     */
    public static function className(): string
    {
        return 'ecommerce/fund/balance';
    }

    /**
     * @param string $subMerchantId
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function retrieve(string $subMerchantId, $query = null, array $options = []): array
    {
        return parent::retrieve($subMerchantId, $query, $options);
    }
}

<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\EndDayBalance;

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
        return 'ecommerce/fund/enddaybalance';
    }

    /**
     * @param string $subMechId
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function retrieve(string $subMechId, $query = null, array $options = []): array
    {
        return parent::retrieve($subMechId, $query, $options);
    }
}

<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\Balance;

use Lmh\WeChatPayV3\Kernel\BaseClient;

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
}

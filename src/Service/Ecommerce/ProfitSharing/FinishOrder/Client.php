<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\FinishOrder;

use Lmh\WeChatPayV3\Kernel\BaseClient;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    public static function className()
    {
        return 'ecommerce/profitsharing/finish-order';
    }

    public function create(array $params, array $options = [])
    {
        return parent::create($params, $options);
    }
}

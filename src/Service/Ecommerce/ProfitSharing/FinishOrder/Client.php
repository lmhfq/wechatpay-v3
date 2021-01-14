<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\FinishOrder;

use Lmh\WeChatPayV3\Kernel\BaseClient;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @return string
     */
    public static function className()
    {
        return 'ecommerce/profitsharing/finish-order';
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws \Throwable
     */
    public function create(array $params, array $options = [])
    {
        return parent::create($params, $options);
    }
}

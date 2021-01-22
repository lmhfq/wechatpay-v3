<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\FinishOrder;

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
        return 'ecommerce/profitsharing/finish-order';
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        return parent::create($params, $options);
    }
}

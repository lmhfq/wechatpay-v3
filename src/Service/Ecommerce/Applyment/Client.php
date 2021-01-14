<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Applyment;

use Lmh\WeChatPayV3\Kernel\BaseClient;
use Throwable;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param string $id
     * @param null $query
     * @param array $options
     * @return array
     * @throws Throwable
     */
    public function retrieve(string $id, $query = null, array $options = [])
    {
        return parent::retrieve($id, $query, $options);
    }

    public function create(array $params, array $options = [])
    {
        return parent::create($params, $options);
    }
}

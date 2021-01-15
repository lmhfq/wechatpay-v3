<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Applyment;

use Lmh\WeChatPayV3\Kernel\BaseClient;
use Throwable;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    protected static $urlName = 'ecommerce/applyments';

    /**
     * @return string
     */
    public static function className()
    {
        return self::$urlName;
    }

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
        //解决特殊接口后缀不一致
        self::$urlName .= '/';
        return parent::create($params, $options);
    }
}

<?php

namespace Lmh\WeChatPayV3\Service\Certificate;

use Lmh\WeChatPayV3\Kernel\BaseClient;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    public function all($query = null, array $options = [])
    {
        return parent::all($query, $options);
    }

    protected function registerHttpMiddleware()
    {
        // auth
        $this->pushMiddleware($this->authMiddleware(), 'auth');

        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');

    }
}

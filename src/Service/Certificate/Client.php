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
        $url = rtrim(self::classUrl(), '/');
        $options = $options + ['query' => $query];
        return $this->request('GET', $url, $options);
    }

    protected function registerHttpMiddleware()
    {
        // auth
        $this->pushMiddleware($this->authMiddleware(), 'auth');

        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');

    }
}

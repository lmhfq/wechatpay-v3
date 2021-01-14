<?php

namespace Lmh\WeChatPayV3\Service\Certificate;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function all($query = null, array $options = [])
    {
        $url = rtrim(self::classUrl(), '/');
        $options = $options + ['query' => $query];
        return $this->request('GET', $url, $options);
    }

    /**
     *
     */
    protected function registerHttpMiddleware()
    {
        // auth
        $this->pushMiddleware($this->authMiddleware(), 'auth');

        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');

    }
}

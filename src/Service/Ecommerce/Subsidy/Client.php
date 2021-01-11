<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Subsidy;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class Client.
 *
 */
class Client extends BaseClient
{
    /**
     * @param array $params
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function create(array $params, array $options = [])
    {
        $url = self::classUrl() . 'create';
        $opts = $options + ['json' => $params];

        return $this->request('POST', $url, $opts);
    }

    /**
     * @param array $params
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function return(array $params, array $options = [])
    {
        $url = self::classUrl() . 'return';
        $opts = $options + ['json' => $params];

        return $this->request('POST', $url, $opts);
    }

    /**
     * @param array $params
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     * @throws Throwable
     */
    public function cancel(array $params, array $options = [])
    {
        $url = self::classUrl() . 'cancel';
        $opts = $options + ['json' => $params];

        return $this->request('POST', $url, $opts);
    }
}

<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Applyment;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
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
    public static function className(): string
    {
        return self::$urlName;
    }

    /**
     * @param string $id
     * @param null $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function retrieve(string $id, $query = null, array $options = []): array
    {
        return parent::retrieve($id, $query, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     * @throws GuzzleException
     */
    public function create(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/';
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * @param string $outTradeNo
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws ResultException
     * @throws Throwable
     */
    public function queryByOutTradeNo(string $outTradeNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-request-no/' . $outTradeNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}

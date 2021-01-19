<?php

namespace Lmh\WeChatPayV3\Service\Apply4Sub\SubMerchant;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Throwable;

/**
 * Class Client.
 *
 */
class Client extends BaseClient
{
    /**
     * @param string $subMerchantId
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function retrieveSettlement(string $subMerchantId, $query = null, array $options = [])
    {
        $url = self::classUrl() . '/' . $subMerchantId . '/settlement';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $subMerchantId
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function updateSettlement(string $subMerchantId, array $params, array $options = [])
    {
        $url = self::classUrl() . '/' . $subMerchantId . '/modify-settlement';
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }
}

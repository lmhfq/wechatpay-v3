<?php

namespace Lmh\WeChatPayV3\Service\ProfitSharing\Order;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * 解冻剩余资金
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function unfreeze(array $params, array $options = []): array
    {
        $url = self::classUrl() . '/unfreeze';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }
}

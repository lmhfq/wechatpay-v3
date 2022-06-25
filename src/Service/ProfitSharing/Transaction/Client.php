<?php
declare(strict_types=1);

namespace Lmh\WeChatPayV3\Service\ProfitSharing\Transaction;


use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    /**
     * 查询订单剩余待分金额
     * @param string $transactionId
     * @param array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @throws ResultException
     */
    public function amount(string $transactionId, array $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/' . $transactionId . '/amounts';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
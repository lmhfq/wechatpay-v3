<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2023/3/20
 * Time: 18:03
 */

namespace Lmh\WeChatPayV3\Service\MerchantService\Complaint;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    public static function className(): string
    {
        return 'merchant-service/complaints-v2';
    }

    /**
     * 查询投诉单列表API
     * @param $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function getList($query = null, array $options = []): array
    {
        $url = self::classUrl();
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $complaintId
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function detail(string $complaintId, array $options = []): array
    {
        $url = self::instanceUrl($complaintId);
        $opts = $options + ['query' => []];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $complaintId
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function negotiationHistory(string $complaintId, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/' . $complaintId . '/negotiation-historys';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Bill;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\HashException;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Lmh\WeChatPayV3\Kernel\Utils\ArrUtil;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @return string
     */
    public static function className(): string
    {
        return 'ecommerce/bill';
    }
    /**
     * @param string|array|null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function retrieveFundFlowBill($query = null, array $options = []): array
    {
        $url = self::classUrl() . '/fundflowbill';
        $opts = $options + ['query' => $query];

        return $this->request('GET', $url, $opts);
    }

    /**
     * @param $body
     * @return string
     * @throws GuzzleException
     * @throws ResultException
     * @throws HashException
     */
    public function download($body): string
    {
        $response = $this->requestRaw('GET', ArrUtil::get($body, 'download_url'));
        $fileStream = $response->getBody()->getContents();
        $response->getBody()->rewind();

        $hashValue = hash(ArrUtil::get($body, 'hash_type'), $fileStream);
        if ($hashValue != ArrUtil::get($body, 'hash_value')) {
            throw new HashException('账单文件哈希值错误，请尝试重新下载');
        }
        return $fileStream;
    }
}

<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Bill;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\HashException;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
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
        $response = $this->requestRaw('GET', Arr::get($body, 'download_url'));
        $fileStream = $response->getBody()->getContents();
        $response->getBody()->rewind();

        $hashValue = hash(Arr::get($body, 'hash_type'), $fileStream);
        if ($hashValue != Arr::get($body, 'hash_value')) {
            throw new HashException('账单文件哈希值错误，请尝试重新下载');
        }
        return $fileStream;
    }
}

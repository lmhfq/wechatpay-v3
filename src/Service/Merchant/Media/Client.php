<?php

namespace Lmh\WeChatPayV3\Service\Merchant\Media;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param $fileName
     * @param $content
     * @param $mimeType
     * @param array $options
     * @return array
     * @throws ResultException
     * @throws GuzzleException
     */
    public function upload($fileName, $content, $mimeType, array $options = []): array
    {
        $signPayload = json_encode([
            'filename' => $fileName,
            'sha256' => hash('sha256', $content),
        ]);

        $multipart = [
            [
                'name' => 'meta',
                'contents' => $signPayload,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ],
            [
                'name' => 'file',
                'filename' => $fileName,
                'contents' => $content,
                'headers' => [
                    'Content-Type' => $mimeType,
                ],
            ],
        ];
        $url = self::classUrl() . '/upload';
        $opts = $options + ['multipart' => $multipart, 'sign_payload' => $signPayload];
        return $this->request('POST', $url, $opts);
    }
}

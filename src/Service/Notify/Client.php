<?php

namespace Lmh\WeChatPayV3\Service\Notify;

use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\InvalidArgumentException;
use Lmh\WeChatPayV3\Kernel\Exceptions\RuntimeException;
use Lmh\WeChatPayV3\Kernel\Utils\AesUtil;
use Lmh\WeChatPayV3\Kernel\Utils\ArrUtil;
use function json_decode;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @param array $resource
     * @return array
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function parseResource(array $resource): ?array
    {
        $aesKey = $this->app['config']->get('aes_key');
        $associatedData = ArrUtil::get($resource, 'associated_data');
        $nonceStr = ArrUtil::get($resource, 'nonce');
        $cipherText = ArrUtil::get($resource, 'ciphertext');
        $data = (new AesUtil($aesKey))->decryptAES256GCM($associatedData, $nonceStr, $cipherText);
        return json_decode($data, true);
    }
}

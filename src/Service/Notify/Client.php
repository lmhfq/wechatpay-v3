<?php

namespace Lmh\WeChatPayV3\Service\Notify;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\InvalidArgumentException;
use Lmh\WeChatPayV3\Kernel\Exceptions\RuntimeException;
use Lmh\WeChatPayV3\Kernel\Utils\AesUtil;
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
    public function parseResource(array $resource)
    {
        $aesKey = Config::get('wechatpay-v3.aes_key', '');
        $associatedData = Arr::get($resource, 'associated_data');
        $nonceStr = Arr::get($resource, 'nonce');
        $cipherText = Arr::get($resource, 'ciphertext');

        $data = (new AesUtil($aesKey))->decryptAES256GCM($associatedData, $nonceStr, $cipherText);

        return json_decode($data, true);
    }
}

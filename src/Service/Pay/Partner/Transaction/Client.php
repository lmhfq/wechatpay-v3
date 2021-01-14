<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/1/14
 * Time: 下午4:22
 */

namespace Lmh\WeChatPayV3\Service\Pay\Partner\Transaction;


use Lmh\WeChatPayV3\Kernel\BaseClient;

class Client extends BaseClient
{
    public static function className()
    {
        return 'pay/partner/transactions';
    }
}
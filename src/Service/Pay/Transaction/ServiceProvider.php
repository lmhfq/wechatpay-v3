<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/1/14
 * Time: 下午4:22
 */

namespace Lmh\WeChatPayV3\Service\Pay\Transaction;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        $app['transaction'] = function ($app) {
            return new Client($app);
        };
    }
}
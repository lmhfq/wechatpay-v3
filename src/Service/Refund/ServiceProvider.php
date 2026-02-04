<?php

namespace Lmh\WeChatPayV3\Service\Refund;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $app['refund'] = function ($app) {
            return new Client($app);
        };
    }
}
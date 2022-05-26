<?php

namespace Lmh\WeChatPayV3\Service\Capital\Capitallhh;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['capitallhh'] = function ($app) {
            return new Client($app);
        };
    }
}

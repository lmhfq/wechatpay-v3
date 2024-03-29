<?php

namespace Lmh\WeChatPayV3\Service\Capital\Capitallhh\Area;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['area'] = function ($app) {
            return new Client($app);
        };
    }
}

<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Bill;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['bill'] = function ($app) {
            return new Client($app);
        };
    }
}

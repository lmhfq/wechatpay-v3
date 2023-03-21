<?php

namespace Lmh\WeChatPayV3\Service\Applyment4Sub\Applyment;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['subApplyment'] = function ($app) {
            return new Client($app);
        };
    }
}

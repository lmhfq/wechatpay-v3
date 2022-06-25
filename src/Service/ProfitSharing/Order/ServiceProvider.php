<?php

namespace Lmh\WeChatPayV3\Service\ProfitSharing\Order;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['profitSharingOrder'] = function ($app) {
            return new Client($app);
        };
    }
}

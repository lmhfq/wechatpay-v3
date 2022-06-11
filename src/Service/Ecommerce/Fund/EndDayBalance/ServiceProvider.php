<?php

namespace Lmh\WeChatPayV3\Service\Ecommerce\Fund\EndDayBalance;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['endDayBalance'] = function ($app) {
            return new Client($app);
        };
    }
}

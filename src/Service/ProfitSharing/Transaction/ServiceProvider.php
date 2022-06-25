<?php
declare(strict_types=1);

namespace Lmh\WeChatPayV3\Service\ProfitSharing\Transaction;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['profitSharingReceiver'] = function ($app) {
            return new Client($app);
        };
    }
}
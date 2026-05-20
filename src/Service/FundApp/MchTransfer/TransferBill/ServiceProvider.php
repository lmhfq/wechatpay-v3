<?php

namespace Lmh\WeChatPayV3\Service\FundApp\MchTransfer\TransferBill;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['mchTransfer'] = function ($app) {
            return new Client($app);
        };
    }
}
<?php
declare(strict_types=1);

namespace Lmh\WeChatPayV3\Service\ProfitSharing\Receiver;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/1/19
 * Time: 下午2:48
 */
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
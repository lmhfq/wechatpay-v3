<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/5/12
 * Time: 上午9:31
 */

namespace Lmh\WeChatPayV3\Service\GoldPlan\Merchants;


use Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\FinishOrder\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider  implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['goldPlanMerchant'] = function ($app) {
            return new Client($app);
        };
    }
}
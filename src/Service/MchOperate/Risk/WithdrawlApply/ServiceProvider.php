<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2023/3/21
 * Time: 11:08
 */

namespace Lmh\WeChatPayV3\Service\MchOperate\Risk\WithdrawlApply;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['riskWithdraw'] = function ($app) {
            return new Client($app);
        };
    }
}
<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2023/3/20
 * Time: 18:03
 */

namespace Lmh\WeChatPayV3\Service\MerchantService\Complaint;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        $app['merchantService'] = function ($app) {
            return new Client($app);
        };
    }
}
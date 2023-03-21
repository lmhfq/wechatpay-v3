<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2023/3/21
 * Time: 10:45
 */

namespace Lmh\WeChatPayV3\Service\Apply4Subject\Applyment;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['subjectApplyment'] = function ($app) {
            return new Client($app);
        };
    }
}
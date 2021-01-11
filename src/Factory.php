<?php

namespace Lmh\WeChatPayV3;

use Lmh\WeChatPayV3\Service\Application;

class Factory
{
    public static function app(array $config = [])
    {
        return new Application($config);
    }
}
<?php

namespace Lmh\WeChatPayV3\Kernel;

use Lmh\WeChatPayV3\Kernel\Providers\ConfigServiceProvider;
use Lmh\WeChatPayV3\Kernel\Providers\HttpClientServiceProvider;
use Lmh\WeChatPayV3\Kernel\Providers\LogServiceProvider;
use Pimple\Container;

/**
 * Class ServiceContainer
 */
class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultConfig = [];

    /**
     * @var array
     */
    protected $userConfig = [];

    public function __construct(array $config = [], array $prepends = [])
    {
        $this->userConfig = $config;

        $this->registerProviders($this->getProviders());

        parent::__construct($prepends);
    }

    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders(): array
    {
        return array_merge([
            ConfigServiceProvider::class,
            HttpClientServiceProvider::class,
            LogServiceProvider::class,
        ], $this->providers);
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        $base = [
            // http://docs.guzzlephp.org/en/stable/request-options.html
            'http' => [
                'timeout' => 30.0,
                'base_uri' => 'https://api.mch.weixin.qq.com/v3',
                'max_retries' => 1,
                'retry_delay' => 500,
            ],
            //商户号
            'mch_id' => '',
            //商户API证书序列号
            'serial_no' => '',
            //商户私钥
            'private_key' => '',
            'aes_key' => '',
            'redisClient' => null
        ];
        return array_replace_recursive($base, $this->defaultConfig, $this->userConfig);
    }

    /**
     * @param string $id
     * @param mixed $value
     */
    public function rebind(string $id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);
    }

    /**
     * Magic get access.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed $value
     */
    public function __set(string $id, $value)
    {
        $this->offsetSet($id, $value);
    }

}
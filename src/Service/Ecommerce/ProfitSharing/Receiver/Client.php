<?php
declare(strict_types=1);

namespace Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\Receiver;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2021/1/19
 * Time: 下午2:47
 */
class Client extends \Lmh\WeChatPayV3\Kernel\BaseClient
{
    /**
     * @return string
     */
    public static function className(): string
    {
        return 'ecommerce/profitsharing/receivers';
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function add(array $params, array $options = [])
    {
        $url = self::classUrl() . '/add';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     * @throws GuzzleException
     */
    public function delete(array $params, array $options = [])
    {
        $url = self::classUrl() . '/delete';
        $options = $options + ['json' => $params];
        return $this->request('POST', $url, $options);
    }
}
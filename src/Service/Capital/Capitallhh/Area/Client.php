<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/5/24
 * Time: 下午4:22
 */

namespace Lmh\WeChatPayV3\Service\Capital\Capitallhh\Area;


use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    /**
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function provincesList($query = null, array $options = []): array
    {
        $url = self::classUrl() . '/areas/provinces';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $provinceCode
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function provinceCityList(string $provinceCode, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/areas/provinces/' . $provinceCode . '/cities';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
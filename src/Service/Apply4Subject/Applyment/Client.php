<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2023/3/21
 * Time: 10:45
 */

namespace Lmh\WeChatPayV3\Service\Apply4Subject\Applyment;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    /**
     * 官方文档未说明该接口支持applyments
     * @return string
     */
//    public static function className(): string
//    {
//        return 'apply4subject/applyment';
//    }
    public function create(array $params, array $options = []): array
    {
        $url = self::classUrl();
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * @param $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryApplyment($query = null, array $options = []): array
    {
        $url = self::classUrl();
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
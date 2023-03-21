<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2023/3/21
 * Time: 11:08
 */

namespace Lmh\WeChatPayV3\Service\MchOperate\Risk\WithdrawlApply;

use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    public static function className(): string
    {
        return 'mch_operate/risk/withdrawl-apply';
    }
    /**
     * @param string $applymentId
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryApplyment(string $applymentId, array $options = []): array
    {
        $url = self::classUrl() . '/applyment-id/' . $applymentId;
        $opts = $options + ['query' => []];
        return $this->request('GET', $url, $opts);
    }

}
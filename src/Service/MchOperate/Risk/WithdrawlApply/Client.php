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
     * 提交已注销商户号可用余额提现申请单
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        return parent::create($params, $options);
    }

    /**
     * 商户提现申请单号查询提现申请单状态
     * @param string $applymentId
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByApplymentId(string $applymentId, array $options = []): array
    {
        $url = self::classUrl() . '/applyment-id/' . $applymentId;
        $opts = $options + ['query' => []];
        return $this->request('GET', $url, $opts);
    }

    /**
     * 商户提现申请单号查询提现申请单状态
     * @param string $outTradeNo
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     */
    public function queryByOutTradeNo(string $outTradeNo, array $options = []): array
    {
        $url = self::classUrl() . '/out-request-no/' . $outTradeNo;
        $opts = $options + ['query' => []];
        return $this->request('GET', $url, $opts);
    }
}
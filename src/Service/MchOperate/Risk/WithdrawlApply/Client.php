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
     * 针对被微信支付平台不收不付管控的电商子商户，如子商户账户内还有可用余额，且无法解脱（例如 营业执照注销吊销），
     * 则服务商可为子商户申请走注销提现的流程，将可用余额进行提现操作。
     * 在商户号注销后，电商平台可发起提现申请, 审批通过后, 将会按照指定的收款方式返回给商户
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
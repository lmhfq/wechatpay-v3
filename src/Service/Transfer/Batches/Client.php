<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/6/9
 * Time: 下午3:23
 */

namespace Lmh\WeChatPayV3\Service\Transfer\Batches;


use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    /**
     * 微信明细单号查询明细单
     * @param string $batchId
     * @param string $detailId
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function queryByDetailId(string $batchId, string $detailId, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/batch-id/' . $batchId . '/details/detail-id/' . $detailId;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * 微信批次单号查询批次单
     * @param string $batchId
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function queryByBatchId(string $batchId, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/batch-id/' . $batchId;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }


    /**
     * 商家批次单号查询批次单
     * @param string $outBatchNo
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function queryByOutBatchNo(string $outBatchNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-batch-no/' . $outBatchNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * 商家明细单号查询明细单
     * @param string $outBatchNo
     * @param string $outDetailNo
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function queryByOutDetailNo(string $outBatchNo, string $outDetailNo, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/out-batch-no/' . $outBatchNo . '/details/out-detail-no/' . $outDetailNo;
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
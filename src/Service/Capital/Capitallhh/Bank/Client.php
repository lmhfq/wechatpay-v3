<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/5/24
 * Time: 下午4:22
 */

namespace Lmh\WeChatPayV3\Service\Capital\Capitallhh\Bank;


use GuzzleHttp\Exception\GuzzleException;
use Lmh\WeChatPayV3\Kernel\BaseClient;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

class Client extends BaseClient
{
    /**
     * @param string $bankAliasCode
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function branchesList(string $bankAliasCode, $query = null, array $options = []): array
    {
        $url = self::classUrl() . '/' . $bankAliasCode . '/branches';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param string $accountNumber
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function getBankInfo(string $accountNumber, array $options = []): array
    {
        $url = self::classUrl() . '/search-banks-by-bank-account';
        $opts = $options + ['query' => ['account_number' => $accountNumber]];
        return $this->request('GET', $url, $opts);
    }


    /**
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function personalBankList($query = null, array $options = []): array
    {
        $url = self::classUrl() . '/personal-banking';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param null $query
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws ResultException
     * @author lmh
     */
    public function corporateBankList($query = null, array $options = []): array
    {
        $url = self::classUrl() . '/corporate-banking';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
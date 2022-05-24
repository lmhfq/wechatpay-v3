<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/5/24
 * Time: 下午4:22
 */

namespace Lmh\WeChatPayV3\Service\Capital\Capitallhh;


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
        $url = self::classUrl() . '/banks/' . $bankAliasCode . '/branches';
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
        $url = self::classUrl() . '/banks/search-banks-by-bank-account';
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
        $url = self::classUrl() . '/banks/personal-banking';
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
        $url = self::classUrl() . '/banks/corporate-banking';
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }
}
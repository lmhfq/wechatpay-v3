<?php

namespace Lmh\WeChatPayV3\Kernel\Traits;

use Illuminate\Support\Str;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;

trait RestfulMethods
{
    /**
     * @param $id
     * @return string
     */
    public function instanceUrl($id): string
    {
        return self::classUrl() . '/' . $id;
    }

    /**
     * @return string
     */
    public static function classUrl(): string
    {
        return '/v3/' . static::className();
    }

    /**
     * @return string
     */
    public static function className(): string
    {
        $className = get_called_class();
        $classes = explode('\\', $className);
        $classes = array_slice($classes, 3, -1);
        foreach ($classes as $key => $val) {
            $classes[$key] = $key == count($classes) - 1 ? Str::plural(Str::snake($val)) : strtolower($val);
        }
        return implode('/', $classes);
    }

    /**
     * 查询
     * @param string $id
     * @param string|null $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function retrieve(string $id, $query = null, array $options = []): array
    {
        $url = $this->instanceUrl($id);
        $opts = $options + ['query' => $query];
        return $this->request('GET', $url, $opts);
    }

    /**
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function create(array $params, array $options = []): array
    {
        $url = self::classUrl();
        $opts = $options + ['json' => $params];
        return $this->request('POST', $url, $opts);
    }

    /**
     * 修改
     * @param string $id
     * @param array $params
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function update(string $id, array $params, array $options = []): array
    {
        $url = self::instanceUrl($id);
        $opts = $options + ['json' => $params];
        return $this->request('PUT', $url, $opts);
    }

    /**
     * 删除
     * @param string $id
     * @param string $query
     * @param array $options
     * @return array
     * @throws ResultException
     */
    public function destroy(string $id, string $query, array $options = []): array
    {
        $url = self::instanceUrl($id);
        $opts = $options + ['query' => $query];
        return $this->request('DELETE', $url, $opts);
    }
}

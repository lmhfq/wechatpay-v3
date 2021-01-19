<?php

namespace Lmh\WeChatPayV3\Kernel\Traits;

use Illuminate\Support\Str;
use Lmh\WeChatPayV3\Kernel\Exceptions\ResultException;
use Throwable;

trait RestfulMethods
{
    /**
     * @param string $id
     * @param string $query
     * @param array $options
     * @return array
     * @throws Throwable
     */
    protected function retrieve(string $id, $query = null, array $options = [])
    {
        $url = $this->instanceUrl($id);
        $opts = $options + ['query' => $query];

        return $this->request('GET', $url, $opts);
    }

    public function instanceUrl($id)
    {
        return self::classUrl() . '/' . $id;
    }

    public static function classUrl()
    {
        return '/v3/' . static::className();
    }

    public static function className()
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
     * @param array $params
     * @param array $options
     * @throws ResultException
     * @return array
     */
    protected function create(array $params, array $options = [])
    {
        $url = self::classUrl();

        $opts = $options + ['json' => $params];

        return $this->request('POST', $url, $opts);
    }

    /**
     * @param string $id
     * @param array $params
     * @param array $options
     * @return array
     * @throws Throwable
     */
    protected function update(string $id, array $params, array $options = [])
    {
        $url = self::instanceUrl($id);
        $opts = $options + ['json' => $params];

        return $this->request('PUT', $url, $opts);
    }

    /**
     * @param string $id
     * @param string $query
     * @param array $options
     * @return array
     * @throws Throwable
     */
    protected function destroy(string $id, string $query, array $options = [])
    {
        $url = self::instanceUrl($id);
        $opts = $options + ['query' => $query];

        return $this->request('DELETE', $url, $opts);
    }
}

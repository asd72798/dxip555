<?php
declare(strict_types=1);

namespace App\Plugin\Redis\Hook;

use App\Util\Client;
use App\Util\Plugin;
use Kernel\Annotation\Hook;
use Kernel\Exception\JSONException;

class Main
{
    const CACHE_URL = [
        'user/api/index/data',
        'user/api/index/commodity',
        'user/api/index/commodityDetail'
    ];

    /**
     * @var \Redis|null
     */
    private static ?\Redis $redis = null;

    /**
     * @return \Redis
     */
    private function getRedis(): \Redis
    {
        if (!self::$redis) {
            $config = Plugin::getConfig("Redis");
            $redis = new \Redis();
            $redis->connect((string)$config['host'], (int)$config['port']);
            $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);
            if ($config['auth']) {
                $redis->auth($config['auth']);
            }
            self::$redis = $redis;
        }
        return self::$redis;
    }

    /**
     * @throws \Kernel\Exception\JSONException
     */
    #[\Kernel\Annotation\Plugin(state: \Kernel\Annotation\Plugin::START)]
    public function start(): void
    {
        $config = Plugin::getConfig("Redis");
        if (!$config['host'] || !$config['port']) {
            throw new JSONException("请先配置好，再启动插件哦。");
        }
        try {
            $this->getRedis();
        } catch (\Error | \Exception $e) {
            throw new JSONException("Redis连接失败，请先配置好Redis再启动。");
        }
    }


    #[Hook(point: \App\Consts\Hook::HTTP_ROUTE_RESPONSE)]
    public function routeAccess(string $route, mixed $response): void
    {
        if (in_array($route, self::CACHE_URL)) {
            $redis = $this->getRedis();
            $key = md5(Client::getUrl() . $route . json_encode((array)$_POST) . json_encode((array)$_GET));
            $redis->set($key, $response, (int)Plugin::getConfig("Redis")["expire"]); //存储数据
        }
    }

    #[Hook(point: \App\Consts\Hook::KERNEL_INIT)]
    public function routeCache(): void
    {
        $route = trim((string)$_GET['s'], "/");
        if (in_array($route, self::CACHE_URL)) {
            $redis = $this->getRedis();
            $key = md5(Client::getUrl() . $route . json_encode((array)$_POST) . json_encode((array)$_GET));
            $response = $redis->get($key);
            if ($response) {
                if (!is_scalar($response)) {
                    header('content-type:application/json;charset=utf-8');
                    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                } else {
                    header("Content-type: text/html; charset=utf-8");
                    echo $response;
                }
                exit;
            }
        }
    }
}
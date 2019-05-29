<?php

namespace tool\pool;

use core\pool\PoolAbstract;

class RedisPool extends PoolAbstract{

    public function create_obj(){
        $config = config('redis');
        $redis = new \Swoole\Coroutine\Redis();
        $redis->connect($config['host'], $config['port']);
        return $redis;
    }
}
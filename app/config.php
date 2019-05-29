<?php

return [
    'server' => [
        'host' => '0.0.0.0',
        'port' => 9503,
        'set' => [
            'worker_num' => 1,
            'daemonize' => false
        ],
    ],
    'request' => [
        'default' => [
            'module' => 'index',
            'controller' => 'index',
            'action' => 'index'
        ],
        'forbid' => ['common']
    ],
    'mysql' => [
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'password' => 'Laravel5.5',
        'database' => 'test1',
		'max' => 100,
		'min' => 20
    ],
    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
        'max' => 100,
        'min' => 20
    ],
    'pool' => [
        // 类型 => 配置
        'mysql' => tool\pool\MysqlPool::class,
        'redis' => tool\pool\RedisPool::class
    ],
    'app' => [
        'chat' => [
            'salt' => 'haha123',
            'default_img' => 'http://39.108.54.246:8099/cang.jpg'
        ],
    ],
];
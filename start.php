<?php

const ROOT_DIR = __DIR__ . '/';

require_once ROOT_DIR . 'init.php';

$server = new swoole_http_server(config('server.host'), config('server.port'));

$server->set(config('server.set'));

# 注册事件
foreach ($events as $event => $callback) {
    $server->on($event, $callback);
}

$server->start();
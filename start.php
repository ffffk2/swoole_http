<?php

require_once './init.php';

$server = new swoole_http_server(config('server.host'), config('server.port'));

$server->set(config('server.set'));

# 注册事件
foreach ($events as $event => $callback) {
    $server->on($event, $callback);
}

$server->start();
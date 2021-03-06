<?php

$_request = function ($request, $response)use($route){
    $response->header('Content-type', 'text/html; charset=utf-8');
    $response->header('Access-Control-Allow-Origin', '*');
    $response->header('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT, PATCH, OPTIONS');
    $response->header('Access-Control-Allow-Headers', 'Authorization, User-Agent, Keep-Alive, Content-Type, X-Requested-With');
    try {
        $url = strtolower($request->server['request_uri']);
        $method = strtolower($request->server['request_method']);
        $route_method = array_merge($route['*'], $route[$method]);
        // 加入路由传参
        $url = explode('/', $url);
        $param = isset($url[2])? $url[2] : '';
        $url = '/' . $url[1];
        // 匹配
        if (array_key_exists($url, $route_method)){
            $url = $route_method[$url];
        }
        $url_arr = explode('/', $url);
        $module = !empty($url_arr[1])? $url_arr[1] : config('request.default.module');
        $controller = ucfirst($url_arr[2]?? config('request.default.controller'));
        $action = $url_arr[3]?? config('request.default.action');
        if (in_array($module, config('request.forbid'))) {
            return_msg('拒绝访问'.$module.'模块');
        } else {
            $class = 'app\\' . $module . '\\controller\\' . $controller;
            if (class_exists($class)) {
                $request->server['module'] = $module;
                $request->server['controller'] = $controller;
                $request->server['action'] = $action;
                core\Request::$request = $request;
                core\Response::$response = $response;
                $obj = new $class();
                if(!method_exists($obj, $action)){
                    throw new Swoole\ExitException($class . '@' . $action . '不存在');
                }
                if ($param) {
                    $obj->$action($param);
                }else{
                    $obj->$action();
                }
            } else {
                $response->end($class . '不存在');
            }
        }
    } catch (\Exception $e) {
        $response->end($e->getMessage());
    }
};

$_WorkerStart = function($server, $worker_id){
    // 连接池
    $config_pool = config('pool');
    foreach ($config_pool as $pool_name => $pool_class) {
        $config = config($pool_name);
        $pool_obj = new $pool_class($config, $pool_name);
        core\pool\Pool::setPool($pool_name, $pool_obj);
    }
    echo '服务启动' . PHP_EOL;
    echo '端口：' . config('server.port') . PHP_EOL . PHP_EOL;

};

return [
    'request' => $_request,
    'WorkerStart' => $_WorkerStart
];

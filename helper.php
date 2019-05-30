<?php

# 获取配置
function config($name = ''){
    $config = $GLOBALS['config'];
    if (empty($name)){
        return $config;
    }
    $arr = explode('.', $name);
    $_config = $config;
    foreach ($arr as $item) {
        if (array_key_exists($item, $_config)){
            $_config = $_config[$item];
        }else{
            return_msg($name.'配置不存在');
        }
    }
    return $_config;
}

# json格式exit
function return_exit($msg = '未知错误', $code = 500){
    throw new Swoole\ExitException(json_encode(['code' => $code, 'msg' => $msg]));
}

# exit
function return_msg($msg){
    throw new Swoole\ExitException($msg);
}

# 实例化Db
function db($table){
    return core\Db::name($table);
}

# 实例化模型
function model($model){
    if (class_exists($model)) {
        $class = $model;
    }else{
        $request = core\Request::$request;
        $module = strtolower($request->server['module']);
        $class = 'app\\' . $module . '\\model\\' . $model;
    }
    if (class_exists($class)) {
        $model = new $class();
        return $model;
    }else{
        throw new Swoole\ExitException($class . '不存在');
    }
}

# 实例化控制器
function controller($controller){
    if (class_exists($controller)) {
        $class = $controller;
    }else{
        $request = core\Request::$request;
        $module = strtolower($request->server['module']);
        $class = 'app\\' . $module . '\\controller\\' . $controller;
    }
    if (class_exists($class)) {
        $controller = new $class();
        return $controller;
    }else{
        throw new Swoole\ExitException($class . '不存在');
    }
}

<?php

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

function return_exit($msg = '未知错误', $code = 500){
    throw new Swoole\ExitException(json_encode(['code' => $code, 'msg' => $msg]));
}

function return_msg($msg){
    throw new Swoole\ExitException($msg);
}

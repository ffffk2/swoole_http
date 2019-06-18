<?php

namespace core;

use core\pool\Pool;
use core\Request;
use core\Response;

class Controller{

    public $pool = [];

    public function __construct(){
        $this->init();
    }

    public function init(){}
    
    public function json($data = ['' => ''], $code = 200, $msg = '成功'){
        $return = json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
        echo date('Y-m-d H:i:s') . PHP_EOL . $return . PHP_EOL . PHP_EOL;
        Response::$response->status($code);
        Response::$response->end($return);
    }

    public function send($return, $code = 200){
        echo date('Y-m-d H:i:s') . PHP_EOL . $return . PHP_EOL . PHP_EOL;
        Response::$response->status($code);
        Response::$response->end($return);
    }

    public function getPoolObj($name){
        $obj = Pool::getObj($name);
        $this->pool[$name] = $obj;
        return $obj;
    }

    # 回收对象
    public function __destruct(){
        foreach ($this->pool as $name => $pool) {
            Pool::freeObj($name, $pool);
        }
    }

    # 获取请求参数
    public function input($index = ''){
        # 获取所有
        if (empty($index)){
            if (Request::$request->get && Request::$request->post) {
                $param = array_merge(Request::$request->get, Request::$request->post);
            }else if(!Request::$request->get && Request::$request->post){
                $param = Request::$request->post;
            }else if(Request::$request->get && !Request::$request->post){
                $param = Request::$request->get;
            }else{
                $param = null;
            }
        }else{
            $index = explode('.', $index);
            if (in_array(strtolower($index[0]), ['get', 'post'])){
                if ($index[1] == ''){
                    $index = $index[0];
                    $param = Request::$request->$index;
                }else{
                    $param = Request::$request;
                    foreach ($index as $item) {
                        $param = $param[$item];
                    }
                }
            }else{
                $param_get = isset(Request::$request->get[$index[0]])? Request::$request->get[$index[0]] : '';
                $param_post = isset(Request::$request->post[$index[0]])? Request::$request->post[$index[0]] : '';
                if (!$param_post && !$param_get){
                    $param = null;
                }else{
                    $param = !empty($param_post)? $param_post : $param_get;
                }
            }
        }
        return $param;
    }
}

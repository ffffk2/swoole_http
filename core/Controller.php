<?php

namespace core;

use core\pool\Pool;
use core\Request;
use core\Response;

class Controller{

    public $request;

    public $response;

    public $pool = [];

    public function __construct(){
        $this->request = Request::$request;
        $this->response = Response::$response;
        $this->init();
    }

    public function init(){}

    public function json($data = ['' => ''], $code = 200, $msg = '成功'){
        $return = json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
        echo date('Y-m-d H:i:s') . PHP_EOL . $return . PHP_EOL . PHP_EOL;
        $this->response->status($code);
        $this->response->end($return);
    }

    public function send($return){
        echo date('Y-m-d H:i:s') . PHP_EOL . $return . PHP_EOL . PHP_EOL;
        $this->response->end($return);
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
            if ($this->request->get && $this->request->post) {
                $param = array_merge($this->request->get, $this->request->post);
            }else if(!$this->request->get && $this->request->post){
                $param = $this->request->post;
            }else if($this->request->get && !$this->request->post){
                $param = $this->request->get;
            }else{
                $param = null;
            }
        }else{
            $index = explode('.', $index);
            if (in_array(strtolower($index[0]), ['get', 'post'])){
                if ($index[1] == ''){
                    $index = $index[0];
                    $param = $this->request->$index;
                }else{
                    $param = $this->request;
                    foreach ($index as $item) {
                        $param = $param[$item];
                    }
                }
            }else{
                $param_get = isset($this->request->get[$index[0]])? $this->request->get[$index[0]] : '';
                $param_post = isset($this->request->post[$index[0]])? $this->request->post[$index[0]] : '';
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
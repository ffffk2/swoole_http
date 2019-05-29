<?php

namespace core;

class Route{

    public static $route = [];

    // 路由规则
    private static $rules = [
        'get'     => [],
        'post'    => [],
        'put'     => [],
        'delete'  => [],
//        'patch'   => [],
//        'head'    => [],
        'options' => [],
        '*'       => [],
//        'alias'   => [],
//        'domain'  => [],
//        'pattern' => [],
//        'name'    => [],
    ];

    public static function rule($rule, $route, $method = '*'){
        if (!preg_match('/^\//', $rule)){
            $rule = '/' . $rule;
        }
        if (!preg_match('/^\//', $route)){
            $route = '/' . $route;
        }
        if (is_array($method)){
            foreach ($method as $metho) {
                self::$rules[$metho][$rule] = $route;
            }
        }else{
            self::$rules[$method][$rule] = $route;
        }
    }

    public static function get($rule, $route){
        self::rule($rule, $route, 'get');
    }

    public static function post($rule, $route){
        self::rule($rule, $route, 'post');
    }

    public static function put($rule, $route){
        self::rule($rule, $route, 'put');
    }

    public static function delete($rule, $route){
        self::rule($rule, $route, 'delete');
    }

    public static function any($rule, $route){
        self::rule($rule, $route);
    }

    public static function getRules(){
        return self::$rules;
    }

}
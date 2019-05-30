<?php

namespace app\index\controller;
use core\Db;
use core\Response;

class Index
{
    public function index()
    {
        $res = model('Student')->limit(10)->select();
        Response::$response->end(json_encode($res));
    }

    public function course_api()
    {
        $data = [
            'username' => 'wyt_admin',
            'password' => 'waiyutong100' 
        ];
        $res = cource_getapi($data, 'user/index/get_token');
        dump($res);
        dump(decodeData($res));
 
    }

    public function api()
    {
        $data = [
        'uid'=> 1 
                   ];
        $data['access_token'] = config('apikey.COURSE_ACCESS_TOKEN');
        $res = getapi($data, 'course/api/resource_record_list');
        dump($res);
        dump(decodeData($res));
 
    }

    public function question_api()
    {
        $data = [
            
        ];
        $url ="http://yunstudy.koo6.cn/Apis/Attrbute/getPhaseList";
        $res = question_api($data, $url);
        dump($res);
    }


   
    
}

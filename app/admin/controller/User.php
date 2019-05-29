<?php

namespace app\admin\controller;

use app\common\controller\Base;
use app\admin\model\Index;

class User extends Base{
    public function index(){
        $indexModel = new Index();
        $res = $indexModel->limit(10)->select();
        $this->json($res);
    }
}
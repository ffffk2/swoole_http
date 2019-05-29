<?php
# 配置
$config = require_once './app/config.php';

# 自动加载
require_once './vendor/autoload.php';

# 函数
require_once 'helper.php';

# 公共
require_once './app/common.php';

# 路由
require_once './app/route.php';

$route = core\Route::getRules();

# 事件
$events = require_once './event.php';




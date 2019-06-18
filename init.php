<?php
# 配置
$config = require_once ROOT_DIR . 'app/config.php';

# 自动加载
require_once ROOT_DIR . 'vendor/autoload.php';

# 函数
require_once ROOT_DIR . 'helper.php';

# 公共
require_once ROOT_DIR . 'app/common.php';

# 路由
require_once ROOT_DIR . 'app/route.php';

# 获取路由
$route = core\Route::getRules();

# 事件
$events = require_once ROOT_DIR . 'event.php';

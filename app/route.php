<?php

use core\Route;

Route::get('/', 'index/index/index');

Route::any('test', 'admin/index/index');

Route::get('user', 'admin/user/index');
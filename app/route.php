<?php

use core\Route;

Route::put('token', 'chat/login/login');
Route::post('register', 'chat/login/register');
Route::get('checkusername', 'chat/login/checkusername');
Route::delete('chat', 'chat/chat/deletechat');
Route::post('chat', 'chat/chat/createchat');
Route::put('chat', 'chat/chat/updatechat');
Route::put('user', 'chat/chat/updateuser');
Route::get('user', 'chat/chat/userlist');
Route::get('friend', 'chat/chat/friendlist');
Route::delete('friend', 'chat/chat/deletefriend');
Route::post('apply', 'chat/chat/createapply');
Route::put('apply', 'chat/chat/updateapply');
Route::get('apply', 'chat/chat/applylist');
Route::post('group', 'chat/chat/creategroup');
Route::get('message', 'chat/chat/messagelist');

Route::any('avatar', 'chat/chat/avatar');
Route::any('image', 'chat/chat/image');


Route::get('test', 'test/Test/test');

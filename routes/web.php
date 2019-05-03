<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/************首页部分路由************/
Route::get('index/index', 'Index\IndexController@index');
Route::get('index/project', 'Index\ProjectController@index');
Route::get('index/leave-message', 'Index\LeaveMessageController@index');
Route::post('index/leave-message/add', 'Index\LeaveMessageController@add');
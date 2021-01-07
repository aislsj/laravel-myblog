<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/













Route::get('/','Home\IndexController@index');//主页
Route::get('/about','Home\AboutController@index');//关于我
Route::get('/share','Home\ShareController@index');//代码分享
Route::get('/time','Home\TimeController@index');//时间轴
Route::get('/gbook','Home\GbookController@index');//留言
//学无止境
Route::group([], function () {
    Route::get('/list','Home\ListController@index');//学无止境
    Route::get('/list/{id}','Home\ListController@index');//学无止境-分类
    Route::get('/list/info/{id}','Home\ListController@info'); //文章详细页
});
//慢生活
Route::group([], function () {
    Route::get('/life','Home\LifeController@index');//慢生活
    Route::get('/info','Home\InfoController@index');//文章内容
});






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


Route::get('/login','IndexController@index');//文章内容



//Route::get('/','IndexController@index');//主页
Route::get('/about','AboutController@index');//关于我
Route::get('/share','ShareController@index');//代码分享
Route::get('/time','TimeController@index');//时间轴
Route::get('/gbook','GbookController@index');//留言
//学无止境
Route::group([], function () {
    Route::get('/list','ListController@index');//学无止境
    Route::get('/list/{id}','ListController@index');//学无止境-分类
    Route::get('/list/info/{id}','ListController@info'); //文章详细页
});
//慢生活
Route::group([], function () {
    Route::get('/life','LifeController@index');//慢生活
    Route::get('/info','InfoController@index');//文章内容
});






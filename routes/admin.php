<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/11/26
 * Time: 10:11
 */

//登录、注销 修改密码
Route::group([], function () {
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('icons', 'IndexController@icon');
    Route::post('update-password', 'IndexController@updatePassword');
});



//后台
Route::group(['middleware' => ['auth:admin']],function(){//,



    //图片上传
    Route::post('/upload','UploadController@upload');
    //后台首页
    Route::group([], function () {
        Route::get('/','IndexController@index');
        Route::get('/homepage','IndexController@homepage');
    });
    //文章管理
    Route::group([], function () {
        Route::resource('/article','ArticleController');//文章管理
        Route::get('/article/more_img/{id}','ArticleController@more_img');//文章封面图修改-多图片
        Route::post('/article/more_img_save','ArticleController@more_img_save');
        Route::get('/article/big_img/{id}','ArticleController@big_img');//文章封面图修改-大图片
        Route::post('/article/big_img_save','ArticleController@big_img_save');
        Route::get('/article/img/{id}','ArticleController@img');//文章封面图修改-普通图片
        Route::post('/article/img_save','ArticleController@img_save');
        Route::get('/article/cancel_img/{id}','ArticleController@cancel_img');//文章封面图修改-取消图片
    });
    //分类管理
    Route::group([], function () {
        Route::resource('/type','TypeController');//学无止境
        Route::resource('/life','LifeController');//慢生活
    });
    //管理员管理
    Route::group([], function () {
        Route::resource('/admin','AdminController');//管理员列表
        Route::post('/admin/ajaxStatus','AdminController@ajaxStatus');//管理员启用停用

    });
    //系统设置
    Route::group([], function () {
        Route::get('/config','SettingController@index');//系统设置
        Route::post('/config/update_config','SettingController@update_config');//保存系统设置
    });
    //页面布局
    Route::group([], function () {
        Route::resource("/banner",'BannerController');//页面布局-轮播图管理
        Route::resource("/rmend",'RmendController');//页面布局-特别推荐文章
        Route::resource("/lable",'LableController');//页面布局-链接标签
        Route::resource("/amity_link",'AmityLinkController');//页面布局-友情链接
    });
});
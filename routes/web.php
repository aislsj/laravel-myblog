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

//后台
Route::group(['namespace'=>'Admin','prefix'=>"admin"],function(){//,'middleware'=>'adminLogin'
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
        Route::resource('/admin','AdminController');
        //管理员状态修改
        Route::post('/admin/ajaxStatus','AdminController@ajaxStatus');
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






<?php

//后台
Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'auth.admin'], function () {
        //后台首页
        Route::group([], function () {
            Route::get('/', 'IndexController@index');
            Route::get('/homepage','IndexController@homepage');
        });
        //图片上传
        Route::post('/uploadImage','UploadController@upload');
        //分类管理
        Route::group([], function () {
            Route::resource('/category','CategoryController');//博文分类
            Route::post('/category/sort','CategoryController@sort');//排序
        });
        //文章管理
        Route::group([], function () {
            Route::resource('/article','ArticleController');//文章管理
            Route::get('/article/addArticleImg','ArticleController@addArticleImg');//文章添加图片
            Route::post('/article/ArticleImgSave','ArticleController@ArticleImgSave');//文章添加图片
        });
        //管理员管理
        Route::group([], function () {
            Route::resource('/admin','AdminController');//管理员列表
            Route::post('/admin/ajaxStatus','AdminController@ajaxStatus');//管理员启用停用

        });
        //页面布局
        Route::group([], function () {
            Route::resource("/banner",'BannerController');//页面布局-轮播图管理
            Route::resource("/rmend",'RmendController');//页面布局-特别推荐文章
            Route::resource("/lable",'LableController');//页面布局-链接标签
        });
        //系统设置
        Route::group([], function () {
            Route::get('/config','SettingController@index');//系统设置
            Route::post('/config/update_config','SettingController@update_config');//保存系统设置
        });


        Route::get('/ceshi','IndexController@ceshi');

    });
    //登录、注销 修改密码
    Route::group([], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout')->name('admin.logout');//后台退出
        Route::get('icons', 'IndexController@icon');
//        Route::post('update-password', 'IndexController@updatePassword');//修改密码
    });
});





Route::group(['namespace' => 'Home'], function () {


    //商品秒杀测试
    Route::group([], function () {
        Route::get('/redis','RedisController@index'); //商品秒杀---设置库存
        Route::get('/redis/start','RedisController@start');//商品秒杀---抢购
        Route::get('/redis/result','RedisController@result');//商品秒杀---查询结果

    });


    //前台
    Route::group([], function () {
        Route::get('/','IndexController@index');//主页
        Route::get('/about','AboutController@index');//关于我
//        Route::get('/time','TimeController@index');//时间轴
//        Route::get('/share','ShareController@index');//代码分享
//        Route::get('/gbook','GbookController@index');//留言

        //文章分类
        Route::group([], function () {
            Route::get('/category/{id}','CategoryController@index');
            Route::get('/category/info/{id}','CategoryController@info');
        });

    });

});


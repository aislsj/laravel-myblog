<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class Configure extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'home.public.header', //模板名
            'App\Http\Distribution\ConfigureController'  //方法名或者类中的方法
        );

        View::composer(
            'home.public.index_left', //模板名
            'App\Http\Distribution\TemplateController'  //方法名或者类中的方法
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Http\ViewComposers\HomePublicComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['home.public.header'], HomePublicComposer::class
        );
        view()->composer(
            ['home.public.index_left'], HomePublicComposer::class
        );
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //设置string默认长度
        Schema::defaultStringLength(191);
        //时间
        \Carbon\Carbon::setLocale('zh');

        \View::composer('layout.sidebar', function($view){
            $topics = \App\Topic::all();
            $view->with('topics', $topics);
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

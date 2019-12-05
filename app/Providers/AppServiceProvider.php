<?php

namespace App\Providers;

use App\Repositories\News\EloquentNews;
use App\Repositories\News\NewsRepository;
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
        $this->app->singleton(NewsRepository::class, EloquentNews::class);
    }
}

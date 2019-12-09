<?php

namespace App\Providers;

use App\Repositories\News\EloquentNews;
use App\Repositories\News\NewsRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

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
        Builder::defaultStringLength(191);

        $this->app->singleton(NewsRepository::class, EloquentNews::class);
    }
}

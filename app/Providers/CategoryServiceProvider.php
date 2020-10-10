<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('shop', function ($view) {
            $categories = Cache::rememberForever('_Categories_', function () {
                return \App\Models\Category::all();
            });

            $view->with('_Categories_', $categories);
        });
    }
}

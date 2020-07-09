<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Category;

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
        View::composer('sidebar', function($view) {
            // カテゴリーのnameカラムを重複させずに取得
            $categories_name = Category::all()
                ->sortBy('name')
                ->groupBy('name');
            $view->with('categories_name', $categories_name);
        });
    }
}

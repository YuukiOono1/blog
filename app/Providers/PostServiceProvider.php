<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Post;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('sidebar', function($view) {
            // カテゴリーの名前を取得してくる
            $post = Post::All();
            dd($post);
            $view->with('post', $post);
        });
    }
}

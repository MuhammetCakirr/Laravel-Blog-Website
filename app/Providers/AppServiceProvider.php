<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post; // Post modeli

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    

        View::composer('footer', function ($view) {
            $randomPosts = Post::inRandomOrder()->limit(3)->get(); 
            $view->with('randomPosts', $randomPosts);
        });

        View::composer('postdetail_header', function ($view) {
            $randomPosts = Post::inRandomOrder()->limit(4)->get(); 
            $view->with('randomPosts', $randomPosts);
        });
    }
}

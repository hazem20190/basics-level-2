<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Facade;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');
        Route::pattern('name', '[a-z]{5}');

        RateLimiter::for('reload', fn(request $request) => Limit::perMinute(3));

        // Route::bind('product', function ($value) {
        //     return Product::where('name', str_replace('-', ' ', $value))->firstOrFail();
        // });

        // share data with all viewa
        Facades\View::share('name', 'hazem');
        //share data with specific view
        Facades\View::composer('welcome', function (View $view) {
            return $view->with('name', 'hazem');
        });
    }
}

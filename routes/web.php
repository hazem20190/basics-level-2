<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Contracts\Routing\UrlGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->middleware(['throttle:reload'])->name('home');


// Route::get('user/{id}/{name}', HomeController::class)
//     ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

// Route::get('/user/{id}/{name}', HomeController::class)
//     ->whereNumber('id')->whereAlpha('name');



// Route::pattern is Define in AppServiceProvider in laravel 12
// Route::get('/user/{id}/{name}', HomeController::class);



Route::prefix('/dashboard')->group(function () {

    // ==================================== dashboard main page
    Route::view('/', 'dashboard')->name('dashboard');

    // ============================================= products
    // Route::get('products/show/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    // Route::resource('products', ProductController::class)->except('show')->parameters(['products' => 'product:slug']);

    Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::resource('products', ProductController::class)->except('show');
});


// Route::prefix('{lang}/dashboard')->middleware('langsetting')->group(function () {

//     // ==================================== dashboard main page
//     Route::view('/', 'dashboard')->name('dashboard');

//     // ============================================= products
//     // Route::get('products/show/{product:slug}', [ProductController::class, 'show'])->name('products.show');
//     // Route::resource('products', ProductController::class)->except('show')->parameters(['products' => 'product:slug']);

//     Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');
//     Route::resource('products', ProductController::class)->except('show');
// })->whereIn('lang', ['en', 'ar']);


// Route::fallback(fn() => to_route('home')); // Arrow Function


// require __DIR__.'/auth.php';

// require __DIR__ . '/admin.php';
// require __DIR__ . '/merchant.php';

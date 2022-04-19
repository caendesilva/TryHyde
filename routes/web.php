<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HydePostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->name('home');

if (config('app.env') === 'production') {
    Route::group([
        'domain' => 'tools.desilva.se',
        'prefix' => 'try-hyde',
    ], function () {
        Route::middleware(['throttle:generations'])->group(function () {
            Route::post('/api/hyde/post/store', [HydePostController::class, 'store'])->name('hyde.post.store');
        });
    });
} else {
    Route::post('/api/hyde/post/store', [HydePostController::class, 'store'])->name('hyde.post.store');
}

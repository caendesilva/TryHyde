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

Route::middleware(['throttle:generations'])->group(function () {
    Route::post('/api/hyde/post/store', [HydePostController::class, 'store'])->name('hyde.post.store');
});

Route::middleware(['throttle:downloads'])->group(function () {
    Route::get('/api/hyde/post/{post}/download', [HydePostController::class, 'download'])->name('hyde.post.download');
});

Route::get('/hyde/post/render/{post}', [HydePostController::class, 'render'])->name('hyde.post.render');
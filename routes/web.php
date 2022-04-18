<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/preview', function () {
    $markdown = file_get_contents(resource_path('markdown/example.md'));
    $document = Spatie\YamlFrontMatter\YamlFrontMatter::markdownCompatibleParse($markdown);
    $post = new Hyde\Framework\Models\MarkdownPost($document->matter(), $document->body());

    return view('hyde::layouts/post')->with([
        'post' => $post,
        'title' => $post->title ?? 'My New Post',
        'markdown' => Hyde\Framework\Actions\MarkdownConverter::parse($post->body),
        'currentPage' => 'posts/demo',
    ])->render();
});


Route::post('/api/hyde/post/store', [HydePostController::class, 'store'])->name('hyde.post.store');
Route::get('/api/hyde/post/{post}/download', [HydePostController::class, 'download'])->name('hyde.post.download');
Route::get('/hyde/post/render/{post}', [HydePostController::class, 'render'])->name('hyde.post.render');
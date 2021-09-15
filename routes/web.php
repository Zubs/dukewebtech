<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|-----------------------------------------------------------------≥---------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = Post::where('published', true)->get();
    return view('welcome')->with('posts', $posts);
})->name('home');

Route::group([
    'middleware' => 'auth',
    'prefix' => '/dashboard',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/edit', [PostController::class, 'create'])->name('create-post');
    Route::post('/edit', [PostController::class, 'store'])->name('store-post');
    Route::get('/edit/{post:slug}', [PostController::class, 'edit'])->name('edit-post');
    Route::get('/review/{post:slug}', [PostController::class, 'review'])->name('edit-post-admin');
    Route::get('/approve/{post:slug}', [PostController::class, 'approve'])->name('approve');
});

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('show-post');

require __DIR__.'/auth.php';

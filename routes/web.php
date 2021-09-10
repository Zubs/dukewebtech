<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
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
    return view('welcome');
})->name('home');

Route::get('/test', function () {
   return view('admin.edit');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => '/dashboard',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/edit', [PostController::class, 'create'])->name('create-post');
    Route::get('/edit/{uuid}', [PostController::class, 'edit']);
});

Route::get('/post/{uuid}', [PostController::class, 'show']);

require __DIR__.'/auth.php';

<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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


Route::get('/', [PostsController::class, 'getBases'])->name('home');


Route::get('/base', [PostsController::class, 'getPosts'])->name('getBasePost');
Route::get('/download_csv', [PostsController::class, 'Download'])->name('download_csv');
Route::get('/download_txt', [PostsController::class, 'Download'])->name('download_csv');

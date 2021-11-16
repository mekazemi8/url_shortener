<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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
    return view('temp');
})->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/make_url', [UrlController::class, 'store'])->name('make-url');
Route::get('/{short_url}', [UrlController::class, 'goto'])->name('goto');
Route::post('/show_views', [UrlController::class, 'show_views_count'])->name('show-views-count');
Route::get('/delete/{id}', [UrlController::class, 'destroy'])->middleware('auth');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/services', 'App\Http\Controllers\PagesController@services');
Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::get('/posts/delete/{id}', 'App\Http\Controllers\PostsController@destroy')->name('posts.destroy');
/*Route::get('/hello', function () {
    return "Hello World";
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/users/{id}', function ($id) {
    return 'This is user ' . $id;
});
Route::get('/services', function () {
    return view('pages.services');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

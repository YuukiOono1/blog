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
Auth::routes();
Route::get('/', 'PostController@index')->name('posts.index');
Route::resource('/posts', 'PostController',
    ['only' => ['create', 'store', 'edit', 'update', 'destroy', 'show']])->middleware('auth');
Route::resource('/posts', 'PostController',
    ['only' => ['show']]);
Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
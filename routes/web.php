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
Route::resource('/users', 'UserController',
    ['only' => ['edit', 'update', 'destroy', 'show']])->middleware('auth');

/*Route::prefix('admin')->as('admin.')->namespace('Admin')->group(function() {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::middleware('auth:admin')->group(function() {
        Route::post('/logout', 'LoginController@logout')->name('logout');
        Route::get('/', 'AdminController@index')->name('index');
    });
});*/

Route::prefix('admin')->namespace('Admin')
->name('admin.')->group(function(){
    Auth::routes();

    Route::resource('/', 'AdminController');
    Route::post('/sort', 'AdminController@sort')->name('sort');
});


Route::get('/test', 'PostController@test');
Route::get('/sample', 'PostController@sample');
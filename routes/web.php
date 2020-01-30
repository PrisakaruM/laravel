<?php

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

Route::get('/', 'Pages\Home@index');
Route::get('/posts', 'Pages\Blog@index');
Route::get('/post/{id}', 'Pages\Blog@details');

Route::prefix('admin')->group(function () {
    Route::resource('post', 'admin\BlogController');
    Route::post('post/table', 'admin\BlogController@selectPosts')->name('posts.list');
    Route::post('post/store', 'admin\BlogController@store')->name('posts.store');
});

Route::get('/home', 'HomeController@index')->name('home');

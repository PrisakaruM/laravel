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

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('post', 'admin\BlogController');
    Route::post('post/table', 'admin\BlogController@selectPosts')->name('posts.list');
    Route::post('post/store', 'admin\BlogController@store')->name('posts.store');
    Route::get('users', 'admin\UserController@index')->name('users.index');
    Route::post('users/table', 'admin\UserController@usersData')->name('users.list');
    Route::get('users/avatar/{id}', 'admin\UserController@avatarChange')->name('user.avatar');
    Route::put('users/avatar/{id}', 'admin\UserController@avatarUpload')->name('user.avatar.upload');
    Route::get('users/password/{id}', 'admin\UserController@passwordChange')->name('user.password.modal');
    Route::put('users/password/{id}', 'admin\UserController@passwordStore')->name('user.password.store');
});

Route::prefix('admin')->group(function () {
    Route::get('login', 'admin\UserController@login_view')->name('login.view');
    Route::post('login', 'admin\UserController@login')->name('login.processing');
    Route::get('logout', 'admin\UserController@logout')->name('logout');
});

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Support\Facades\Route;

Route::post('/signup/store', 'AuthController@signup');
Route::post('/login', 'AuthController@login');
Route::get('/', function () { return view('home'); });
Route::get('/posts', function() {return view('post'); });
Route::get('/posts/index', "PostController@index");
Route::get('/signup', function() { return view('signup'); });
Route::get('/login', function() { return view('login'); })->name('login');
Route::get('/post-create', function() { return view('createPost'); });
Route::get('/post-single', function() { return view('singlePost'); });
Route::get('/post/{id}', "PostController@show");
Route::get('/post-edit', function() { return view('editPost'); });

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/check-token', 'AuthController@checkToken');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/post', "PostController@store");
    Route::put('/post', 'PostController@update');
    Route::delete('/post/{id}', 'PostController@destroy');
});

// Route::get('/{any}', function () { return view('Homepage'); })->where('any', '.*');
// group範例
// Route::group([
// 	'middleware' => ['checkValidIp'],
// 	'prefix' => 'web',
// 	'namespace' => 'web'
// ], function() {
// 	Route::get('/index', 'HomeController@index');
// 	Route::post('/print', 'HomeController@print');
// });

// Route::get('/index', 'HomeController@index');

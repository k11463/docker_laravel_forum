<?php

use Illuminate\Support\Facades\Route;

Route::post('/signup/store', 'AuthController@signup');
Route::post('/login', 'AuthController@login');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/check-token', 'AuthController@checkToken');
    Route::get('/logout', 'AuthController@logout');
    Route::resource('/post', PostController::class);
});
Route::get('/', function () { return view('Homepage'); });
Route::get('/signup', function() { return view('Signup'); });
Route::get('/login', function() { return view('Login'); })->name('login');
Route::get('/create-post', function() { return view('CreatePost'); });


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

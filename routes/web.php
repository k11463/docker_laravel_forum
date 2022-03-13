<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () { return view('Homepage'); })->where('any', '.*');
// views
// Route::get('/', function () { return view('Homepage'); });
// Route::get('signup', function() { return view('Signup'); });
// Route::get('signin', function() { return view('Signin'); });

Route::post('signup/store', 'AuthController@signup');
Route::resource('posts', PostsController::class);

// Route::group([
// 	'middleware' => ['checkValidIp'],
// 	'prefix' => 'web',
// 	'namespace' => 'web'
// ], function() {
// 	Route::get('/index', 'HomeController@index');
// 	Route::post('/print', 'HomeController@print');
// });

// Route::get('/index', 'HomeController@index');

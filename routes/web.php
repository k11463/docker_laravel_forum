<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Homepage');
});

// Route::group([
// 	'middleware' => ['checkValidIp'],
// 	'prefix' => 'web',
// 	'namespace' => 'web'
// ], function() {
// 	Route::get('/index', 'HomeController@index');
// 	Route::post('/print', 'HomeController@print');
// });

// Route::get('/index', 'HomeController@index');
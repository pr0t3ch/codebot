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

use App\Http\Controllers\BotController;
use App\Http\Controllers\Api\v1\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('bot')
    ->group(function () {
        Route::get('/webhook', 'BotController@subscribe');
        Route::post('/webhook', 'BotController@receiveMessage');
    });

Route::prefix('api/v1')
    ->namespace('Api\v1')
    ->group(function () {
        Route::get('users/me', 'UserController@me');
    });

Route::prefix('api/v1')
    ->middleware('auth')
    ->namespace('Api\v1')
    ->group(function () {
        Route::resource('/users', 'UserController');
    });




Auth::routes();

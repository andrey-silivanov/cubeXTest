<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => 'Auth',
    'prefix'    => 'auth'
], function () {

    Route::post('register', [
        'as'   => 'register',
        'uses' => 'RegisterController@register'
    ]);

    Route::post('login', [
        'as'   => 'login',
        'uses' => 'LoginController@login'
    ]);

    Route::get('/home', function() {
        return new \App\Http\Resources\UserResource(Auth::user());
    })->middleware('auth.jwt');
});

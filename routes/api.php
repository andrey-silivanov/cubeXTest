<?php
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

    Route::group([
        'middleware' => 'auth.jwt'
    ], function () {

        Route::get('user', [
            'as'   => 'getUser',
            'uses' => 'LoginController@user'
        ]);

        Route::get('refresh', [
            'as'   => 'refresh',
            'uses' => 'LoginController@refresh'
        ]);

        Route::post('logout', [
            'as'   => 'logout',
            'uses' => 'LoginController@logout'
        ]);
    });
});

/****** Message *****/
Route::group([
    'middleware' => 'auth.jwt',
    'as'         => 'message'
], function () {
    Route::group([
        'middleware' => ['role:user'],
    ], function () {
        Route::get('/message/check', [
            'as'   => '.check',
            'uses' => 'MessageController@check'
        ]);
        Route::post('message/send', [
            'as'   => '.send',
            'uses' => 'MessageController@send'
        ]);
    });

    Route::group([
        'middleware' => ['role:user'],  ////@TODO !!!!!!!!!!!!!!!!! change
    ], function () {
        Route::get('/message/all', [
            'as'   => '.all',
            'uses' => 'MessageController@index'
        ]);
        Route::put('/message/answer/{message}', [
            'as'   => '.answer',
            'uses' => 'MessageController@answer'
        ]);
        Route::get('/message/{message}', [
            'as'   => '.show',
            'uses' => 'MessageController@show'
        ]);
    });
});



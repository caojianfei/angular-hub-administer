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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app(\Dingo\Api\Routing\Router::class);

$api->version('v1', ['namespace' => 'App\\Http\\Controllers\\Api'], function($api) {

    $api->post('captchas', 'CaptchasController@store')->name('captchas.create');
    $api->post('register', 'RegisterController@store')->name('register');
    $api->post('login', 'LoginController@login')->name('login');
    $api->post('password/email', 'ForgotPasswordController@sendEmailToken')->name('password.email');
    $api->post('password/reset', 'ResetPasswordController@reset')->name('password.reset');


});
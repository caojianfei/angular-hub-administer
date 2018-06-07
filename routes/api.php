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

$api = app(\Dingo\Api\Routing\Router::class);

$api->version('v1', [
    'namespace' => 'App\\Http\\Controllers\\Api',
    'middleware' => ['serializer:array', 'bindings']
], function ($api) {

    // 登录、注册等
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 注册
        $api->post('users', 'UsersController@store')->name('users.store');
        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')->name('authorizations.store');
        // 发送重置密码校验 token
        $api->post('password/email', 'PasswordsController@store')->name('password.email');
        // 重置密码
        $api->patch('password', 'PasswordsController@update')->name('password.update');
    });

    // 普通请求
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // 获取图片验证码
        $api->post('captchas', 'CaptchasController@store')->name('captchas.store');
        // 文章
        $api->resource('articles', 'ArticlesController');
        // 文件上传
        $api->post('image', 'UploadController@image')->name('upload.image');
        // 标签
        $api->resource('tags', 'TagsController');
        // 点赞
        $api->post('article/{article}/like', 'ArticleLikeController@store');

        // 获取当前登录的用户
        $api->get('user', 'UsersController@me')->name('user.show');
        // 个人信息修改
        $api->patch('user', 'UsersController@update')->name('user.update');
    });


});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/**
 * 认证相关接口，除了login其他需要权限，具体设置在AuthController的构造函数里面设置了
 */
Route::group([
//    'middleware' => 'api',    // 官方文档是要加这行的，其实可以不加，不起作用
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

/**
 * 用户额外接口,应配置在基础接口之前，否则users/info，会变成请求id为info的user，而报错
 */
Route::group([
    'prefix' => 'users',
    'middleware' => 'auth:api'
], function ($router) {
    Route::get('info', 'UserController@info');
});

/**
 * 文章额外接口
 */
Route::group([
    'prefix' => 'articles',
    'middleware' => 'auth:api'
], function ($router) {
    Route::post('publish', 'ArticleController@publish');
    Route::post('unpublish', 'ArticleController@unpublish');
});

/**
 * 基础接口
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('articles','ArticleController');
    Route::apiResource('users','UserController');
});



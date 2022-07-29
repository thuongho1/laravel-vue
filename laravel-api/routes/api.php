<?php

use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

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

Route::namespace('Api\V1\Auth')->prefix('api/v1')->middleware('json.api')->group(function () {
    Route::post('/login', 'LoginController');
    Route::post('/register', 'RegisterController');
    Route::post('/logout', 'LogoutController')->middleware('auth:api');
    Route::post('/password-forgot', 'ForgotPasswordController');
    Route::post('/password-reset', 'ResetPasswordController');
});

JsonApi::register('v1')->middleware('auth:api')->routes(function ($api) {
    $api->get('me', 'Api\V1\MeController@readProfile');
    $api->patch('me', 'Api\V1\MeController@updateProfile');

    $api->resource('users');


});

//Route::namespace('Api\V1\Content')->prefix('api/v1')->middleware('json.api')->group(function () {
//
//});

JsonApi::register('v1')->withNamespace('Api\V1\Content\Post')->routes(function ($api) {
    $api->resource('posts')->only('update', 'store', 'delete')->middleware('auth.api');
    $api->resource('posts')->readOnly()->middleware('json.api');
});
JsonApi::register('v1')->withNamespace('Api\V1\Content\Comment')->singularControllers()->routes(function ($api) {
    $api->resource('comments')->only('update', 'store', 'delete')->middleware('auth.api');
    $api->resource('comments')->readOnly()->middleware('json.api');
});
//JsonApi::register('v1')->withNamespace('Api\V1\Content')->middleware('auth.api')->routes(function ($api) {
//    $api->resource('posts')->only('update', 'store', 'delete');;
//    $api->resource('comments')->only('update', 'store', 'delete');
//});
//JsonApi::register('v1')->withNamespace('Api\V1\Content')->routes(function ($api) {
//    $api->resource('posts')->readOnly();
//    $api->resource('comments')->readOnly();
//});
//JsonApi::register('v1')->middleware('auth:api')->routes(function ($api) {
//    $api->get('posts', 'Api\V1\Controller@index');
//    $api->patch('posts', 'Api\V1\MeController@updateProfile');
//
//});
// Post

JsonApi::register('v1')->routes(function ($api) {
    $api->resource('posts')->readOnly();
    $api->resource('comments')->readOnly();
});

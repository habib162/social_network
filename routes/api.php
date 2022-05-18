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

Route::post('auth/login', 'App\Http\Controllers\AuthController@login');
// register routes
Route::post('auth/register', 'App\Http\Controllers\AuthController@register');

Route::post('page/create', 'App\Http\Controllers\PageController@create')->middleware('auth:api');
Route::post('follow/person/{personId}', 'App\Http\Controllers\FollowController@create')->middleware('auth:api');
Route::post('follow/page/{pageId}', 'App\Http\Controllers\PageController@followpage')->middleware('auth:api');

Route::post('person/attach-post', 'App\Http\Controllers\PostController@create')->middleware('auth:api');
Route::post('page/{pageId}/attach-post', 'App\Http\Controllers\PostController@pagepost')->middleware('auth:api');
Route::get('person/feed', 'App\Http\Controllers\FeedController@feed')->middleware('auth:api');
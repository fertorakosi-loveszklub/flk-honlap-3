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

Route::get('/latest-articles', '\App\Http\Controllers\Api\ArticleController@latest');
Route::get('/articles', '\App\Http\Controllers\Api\ArticleController@index');
Route::get('/articles/{slug}', '\App\Http\Controllers\Api\ArticleController@show');

Route::get('/pages/rolunk', '\App\Http\Controllers\Api\PageController@showAbout');

Route::get('/documents', '\App\Http\Controllers\Api\DocumentController@index');

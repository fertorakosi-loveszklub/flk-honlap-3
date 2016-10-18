<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/facebook/login', 'FacebookAuthController@login');
Route::get('/facebook/callback', 'FacebookAuthController@callback');

Route::get('/', 'HomeController@index');
Route::get('/kepek', 'GalleryController@index');
Route::get('/kepek/{slug}', 'GalleryController@show');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'HomeController@adminIndex');
    Route::resource('/news', 'NewsController', ['except' => ['show']]);
    Route::resource('/galleries', 'GalleryController', ['except' => ['show']]);
});

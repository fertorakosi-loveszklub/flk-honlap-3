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
Route::get('/auth/logout', 'FacebookAuthController@logout');

Route::get('/', 'HomeController@index');
Route::get('/rolunk', 'PageController@showAbout');
Route::get('/galeria', 'GalleryController@showList');
Route::get('/galeria/{slug}', 'GalleryController@show');
Route::get('/hirek', 'NewsController@showList');
Route::get('/hirek/{slug}', 'NewsController@show');
Route::get('/hirek/{slug}/amp', 'NewsController@showAmp');
Route::get('/dokumentumok', 'DocumentController@showList');
Route::get('/kapcsolat', 'ContactController@index');
Route::post('/kapcsolat', 'ContactController@postContact');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'HomeController@adminIndex');
    Route::post('/name', 'FacebookAuthController@saveName');
    Route::resource('/news', 'NewsController', ['except' => ['show']]);
    Route::resource('/galleries', 'GalleryController', ['except' => ['show']]);
    Route::resource('/documents', 'DocumentController', ['except' => ['show']]);
    Route::resource('/pages', 'PageController', ['except' => ['show']]);
});

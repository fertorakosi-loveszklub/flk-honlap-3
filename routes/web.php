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

Route::group(['prefix' => 'admin'], function () {

});

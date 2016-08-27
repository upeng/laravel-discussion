<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PostController@index');

Route::resource('discussions', 'PostController');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('comments', 'CommentController');
Route::post('/post/upload', 'PostController@upload');

Route::get('/avatar', 'PostController@avatar');
Route::post('/avatar', 'PostController@changeAvatar');

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/signup', 'HomeController@signup')->name('signup');
Route::post('/signup', 'SessionController@signup')->name('session.signup');
Route::post('/signin', 'SessionController@signup')->name('session.signin');
Route::get('/signout', 'SessionController@signout')->name('session.signout');


Route::resource('user', 'UserController', ['only' => [
    'show', 'edit', 'update'
]]);

Route::get('search', 'SearchController@index')->name('search');

Route::resource('idea', 'IdeaController');

Route::resource('discuss', 'DiscussController', ['only' => [
    'index', 'create', 'show', 'destroy'
]]);

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

Route::resource('user', 'UserController', ['only' => [
    'show', 'edit', 'update'
]]);

Route::get('search', 'SearchController@index')->name('search');

Route::resource('idea', 'IdeaController');

Route::resource('discuss', 'DiscussController', ['only' => [
    'index', 'create', 'show', 'destroy'
]]);

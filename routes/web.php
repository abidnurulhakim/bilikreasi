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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin', 'as' => 'admin.'], function () {
    Route::get('', ['uses'=>'AdminController@index', 'as' => 'index']);
    Route::resource('user', 'UserController');
    Route::resource('idea', 'IdeaController');
    Route::get('tag/{id}/publish', ['uses'=>'TagController@publish', 'as' => 'tag.publish']);
    Route::get('tag/{id}/unpublish', ['uses'=>'TagController@unpublish', 'as' => 'tag.unpublish']);
    Route::resource('tag', 'TagController');
    Route::get('skill/{id}/publish', ['uses'=>'SkillController@publish', 'as' => 'skill.publish']);
    Route::get('skill/{id}/unpublish', ['uses'=>'SkillController@unpublish', 'as' => 'skill.unpublish']);
    Route::resource('skill', 'SkillController');
    Route::get('interest/{id}/publish', ['uses'=>'InterestController@publish', 'as' => 'interest.publish']);
    Route::get('interest/{id}/unpublish', ['uses'=>'InterestController@unpublish', 'as' => 'interest.unpublish']);
    Route::resource('interest', 'InterestController');
});
Route::group(['prefix' => '/'], function () {
    Route::get('', ['uses'=>'HomeController@index', 'as' => 'home.index']);
    Route::get('login', ['uses'=>'HomeController@login', 'as' => 'home.login', 'middleware' => 'guest']);
    Route::post('login', ['uses'=>'SessionController@login', 'as' => 'session.login', 'middleware' => 'guest']);
    Route::get('register', ['uses'=>'HomeController@register', 'as' => 'home.register', 'middleware' => 'guest']);
    Route::post('register', ['uses'=>'SessionController@register', 'as' => 'session.register', 'middleware' => 'guest']);
    Route::get('logout', ['uses'=>'SessionController@logout', 'as' => 'session.logout', 'middleware' => 'auth']);

    /*route for discuss*/
    Route::resource('discuss', 'DiscussController', ['only' => [
        'index', 'show'
    ]]);
    Route::post('discuss/{id}/message', ['uses'=>'DiscussController@sendMessage', 'as' => 'discuss.send.message']);

    /*route for idea*/
    Route::get('idea/{slug}/invitation/{user}', ['uses'=>'IdeaController@invitation', 'as' => 'idea.invitation']);
    Route::get('idea/{slug}/invitation/{user}/remove', ['uses'=>'IdeaController@removeInvitation', 'as' => 'idea.invitation.remove']);
    Route::get('idea/{slug}/like/{user}', ['uses'=>'IdeaController@like', 'as' => 'idea.like']);
    Route::get('idea/{slug}/unlike/{user}', ['uses'=>'IdeaController@unlike', 'as' => 'idea.unlike']);
    Route::get('idea/{slug}/join', ['uses'=>'IdeaController@join', 'as' => 'idea.join']);
    Route::get('idea/{slug}/members', ['uses'=>'IdeaController@members', 'as' => 'idea.members']);
    Route::get('idea/{slug}/search', ['uses'=>'SearchController@partner', 'as' => 'idea.search.partner']);
    Route::resource('idea', 'IdeaController');

    /*route for search*/
    Route::get('search', ['uses'=>'SearchController@index', 'as' => 'search.index']);

    /*route for user*/
    Route::get('user/{username}/change-password', ['uses'=>'UserController@editPassword', 'as' => 'user.edit-password']);
    Route::post('user/{username}/change-password', ['uses'=>'UserController@updatePassword', 'as' => 'user.update-password']);
    Route::get('user/{username}/invitations', ['uses'=>'UserController@invitation', 'as' => 'user.invitation']);
    Route::resource('user', 'UserController', ['only' => [
        'show', 'edit', 'update'
    ]]);
});


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
    Route::get('banner/{id}/publish', ['uses'=>'BannerController@publish', 'as' => 'banner.publish']);
    Route::get('banner/{id}/unpublish', ['uses'=>'BannerController@unpublish', 'as' => 'banner.unpublish']);
    Route::resource('banner', 'BannerController');

    Route::resource('idea', 'IdeaController');
    
    Route::get('feedback/{id}/reply', ['uses'=>'FeedbackController@reply', 'as' => 'feedback.reply']);
    Route::post('feedback/{id}/reply', ['uses'=>'FeedbackController@replyStore', 'as' => 'feedback.reply.store']);
    Route::resource('feedback', 'FeedbackController');

    Route::get('interest/{id}/publish', ['uses'=>'InterestController@publish', 'as' => 'interest.publish']);
    Route::get('interest/{id}/unpublish', ['uses'=>'InterestController@unpublish', 'as' => 'interest.unpublish']);
    Route::resource('interest', 'InterestController');
    
    Route::get('popular/{id}/idea/create', ['uses'=>'PopularController@createIdea', 'as' => 'popular.idea.create']);
    Route::post('popular/{id}/idea', ['uses'=>'PopularController@storeIdea', 'as' => 'popular.idea.store']);
    Route::delete('popular/idea/{id}', ['uses'=>'PopularController@destroyIdea', 'as' => 'popular.idea.destroy']);
    Route::get('popular/{id}/publish', ['uses'=>'PopularController@publish', 'as' => 'popular.publish']);
    Route::get('popular/{id}/unpublish', ['uses'=>'PopularController@unpublish', 'as' => 'popular.unpublish']);
    Route::resource('popular', 'PopularController');
    
    Route::get('skill/{id}/publish', ['uses'=>'SkillController@publish', 'as' => 'skill.publish']);
    Route::get('skill/{id}/unpublish', ['uses'=>'SkillController@unpublish', 'as' => 'skill.unpublish']);
    Route::resource('skill', 'SkillController');
    
    Route::get('tag/{id}/publish', ['uses'=>'TagController@publish', 'as' => 'tag.publish']);
    Route::get('tag/{id}/unpublish', ['uses'=>'TagController@unpublish', 'as' => 'tag.unpublish']);
    Route::resource('tag', 'TagController');
    
    Route::resource('user', 'UserController');
});
Route::group(['prefix' => '/'], function () {
    Route::get('', ['uses'=>'HomeController@index', 'as' => 'home.index']);
    Route::get('auth/facebook', ['uses' => 'SocialAuthController@facebookRedirect', 'as' => 'auth.social.facebook']);
    Route::get('auth/facebook/callback', ['uses' => 'SocialAuthController@facebookCallback', 'as' => 'auth.social.facebook.callback']);
    Route::get('auth/google', ['uses' => 'SocialAuthController@googleRedirect', 'as' => 'auth.social.google']);
    Route::get('auth/google/callback', ['uses' => 'SocialAuthController@googleCallback', 'as' => 'auth.social.google.callback']);
    Route::post('pusher/auth', ['uses'=>'SessionController@pusherAuth', 'as' => 'pusher', 'middleware' => 'auth']);
    Route::get('login', ['uses'=>'HomeController@login', 'as' => 'home.login', 'middleware' => 'guest']);
    Route::post('login', ['uses'=>'SessionController@login', 'as' => 'session.login', 'middleware' => 'guest']);
    Route::get('register', ['uses'=>'HomeController@register', 'as' => 'home.register', 'middleware' => 'guest']);
    Route::get('register/confirmation/{id}', ['uses'=>'HomeController@accountConfirmation', 'as' => 'home.register.confirmation']);
    Route::post('register', ['uses'=>'SessionController@register', 'as' => 'session.register', 'middleware' => 'guest']);
    Route::get('logout', ['uses'=>'SessionController@logout', 'as' => 'session.logout', 'middleware' => 'auth']);

    /*route for discuss*/
    Route::resource('discussion', 'DiscussionController', ['only' => [
        'index', 'show'
    ]]);
    Route::get('discussion/{id}/message/unread', ['uses'=>'DiscussionController@unreadMessages', 'as' => 'discussion.message.unread', 'middleware' => 'auth']);
    Route::get('discussion/{id}/message/read', ['uses'=>'DiscussionController@readMessages', 'as' => 'discussion.message.read', 'middleware' => 'auth']);
    Route::post('discussion/{id}/message', ['uses'=>'DiscussionController@sendMessage', 'as' => 'discussion.send.message', 'middleware' => 'auth']);

    /*route for feedback*/
    Route::post('feedback', ['uses'=>'FeedbackController@store', 'as' => 'feedback.store']);

    /*route for idea*/
    Route::get('idea/{slug}/invitation/{user}', ['uses'=>'IdeaController@invitation', 'as' => 'idea.invitation']);
    Route::get('idea/{slug}/invitation/{user}/remove', ['uses'=>'IdeaController@removeInvitation', 'as' => 'idea.invitation.remove']);
    Route::get('idea/{slug}/like/{user}', ['uses'=>'IdeaController@like', 'as' => 'idea.like']);
    Route::get('idea/{slug}/unlike/{user}', ['uses'=>'IdeaController@unlike', 'as' => 'idea.unlike']);
    Route::get('idea/{slug}/join', ['uses'=>'IdeaController@join', 'as' => 'idea.join']);
    Route::get('idea/{slug}/members', ['uses'=>'IdeaController@members', 'as' => 'idea.members']);
    Route::get('idea/{slug}/quick-look', ['uses'=>'IdeaController@quickLook', 'as' => 'idea.quick-look']);
    Route::get('idea/{slug}/search', ['uses'=>'SearchController@partner', 'as' => 'idea.search.partner']);
    Route::resource('idea', 'IdeaController', ['except' => ['store']]);
    Route::post('idea-media/{slug}', ['uses'=>'IdeaMediaController@store', 'as' => 'idea.media.store']);

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


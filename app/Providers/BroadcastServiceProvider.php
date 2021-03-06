<?php

namespace App\Providers;

use App\Models\DiscussionParticipant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.User.*', function ($user, $userId) {
            return (int) $user->id === (int) $userId;
        });

        Broadcast::channel('private-discussion.*', function ($user, $discussionId) {
            return DiscussionParticipant::whereUserId($user->id)->whereDiscussionId($discussionId)->count() > 0;
        });
    }
}

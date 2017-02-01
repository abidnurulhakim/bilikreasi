<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function view(User $user, Discussion $discussion)
    {
        $idea = $discussion->$idea;
        return $idea->isMember($user) || $user->isAdmin();
    }

    /**
     * Determine whether the user can get messages the discuss.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function messages(User $user, Discussion $discussion)
    {
        $idea = $discussion->$idea;
        return $idea->isMember($user) || $user->isAdmin();
    }


    /**
     * Determine whether the user can delete the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function delete(User $user, Discussion $discussion)
    {
        $idea = $discussion->$idea;
        return $idea->isAdmin($user) || $user->isAdmin();
    }

}

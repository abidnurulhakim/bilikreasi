<?php

namespace App\Policies;

use App\User;
use App\Idea;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class IdeaMediaPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can store the idea media.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function store(User $user, Idea $idea)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function delete(User $user, Idea $idea)
    {
        return $idea->isAdmin($user);
    }
}

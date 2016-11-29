<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Discuss;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function view(User $user, Discuss $discuss)
    {
        $idea = $discuss->$idea;
        return $idea->isMember($user) || $user->isAdmin();
    }

    /**
     * Determine whether the user can get messages the discuss.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function messages(User $user, Discuss $discuss)
    {
        $idea = $discuss->$idea;
        return $idea->isMember($user) || $user->isAdmin();
    }


    /**
     * Determine whether the user can delete the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function delete(User $user, Discuss $discuss)
    {
        $idea = $discuss->$idea;
        return $idea->isAdmin($user) || $user->isAdmin();
    }

}

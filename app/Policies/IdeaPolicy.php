<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdeaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function view(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can create ideas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->confirmed;
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function edit(User $user, Idea $idea)
    {
        return $idea->isAdmin($user);
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function update(User $user, Idea $idea)
    {
        return $idea->isAdmin($user);
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
        return $user->id === $idea->user_id;
    }

    /**
     * Determine whether the user can join the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function join(User $user, Idea $idea)
    {
        return $idea->members()->find($user->id)->pivot->role != 'banned';
    }

    /**
     * Determine whether the user can see member of idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function members(User $user, Idea $idea)
    {
        return $idea->isMember($user);
    }
}

<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\Member;
use App\Models\User;

class IdeaService
{
    public static function join(Idea $idea, User $user, $role = 'member')
    {
        $member = Member::where('idea_id', $idea->id)
                        ->where('user_id', $user->id)
                        ->first();
        if ($member) {
            return $member;
        }
        $member = Member::onlyTrashed()
                        ->where('idea_id', $idea->id)
                        ->where('user_id', $user->id)
                        ->first();
        if ($member) {
            if ($member->restore()) {
                return $member;
            } else {
                return null;
            }
        }
        return Member::create(['user_id' => $idea->user_id, 'idea_id' => $idea->id, 'role' => 'admin']);
    }
}
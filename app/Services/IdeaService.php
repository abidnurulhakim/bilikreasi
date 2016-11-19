<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\Member;
use App\Models\User;
use App\Models\Like;
use App\Models\IdeaInvitation;

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
                $member->role = $role;
                $member->save();
                return $member;
            } else {
                return null;
            }
        }
        return Member::create(['user_id' => $user->id, 'idea_id' => $idea->id, 'role' => $role]);
    }

    public static function createInvitation(Idea $idea, User $user)
    {
        $invitation = IdeaInvitation::onlyTrashed()->where('user_id', $user->id)->where('idea_id', $idea->id)->first();
        if ($invitation) {
            $invitation->restore();
            return $invitation;
        }
        return IdeaInvitation::create(['user_id' => $user->id, 'idea_id' => $idea->id]);
    }

    public static function removeInvitation(Idea $idea, User $user)
    {
        $invitation = IdeaInvitation::where('user_id', $user->id)->where('idea_id', $idea->id)->first();
        if ($invitation) {
            $invitation->delete();
        }
        return $invitation;
    }

    public static function like(Idea $idea, User $user)
    {
        $invitation = Like::onlyTrashed()->where('user_id', $user->id)->where('idea_id', $idea->id)->first();
        if ($invitation) {
            $invitation->restore();
            return $invitation;
        }
        return Like::create(['user_id' => $user->id, 'idea_id' => $idea->id]);
    }

    public static function unlike(Idea $idea, User $user)
    {
        $invitation = Like::where('user_id', $user->id)->where('idea_id', $idea->id)->first();
        if ($invitation) {
            $invitation->delete();
        }
        return $invitation;
    }
}
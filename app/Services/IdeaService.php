<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\IdeaMember;
use App\Models\User;
use App\Models\Like;
use App\Models\IdeaInvitation;
use App\Services\DiscussionServices;

class IdeaService
{
    public static function join(Idea $idea, User $user, $role = 'member')
    {
        $member = IdeaMember::where('idea_id', $idea->id)
                        ->where('user_id', $user->id)
                        ->first();
        if ($member) {
            return $member;
        }
        $member = IdeaMember::onlyTrashed()
                        ->where('idea_id', $idea->id)
                        ->where('user_id', $user->id)
                        ->first();
        if ($member) {
            if ($member->restore()) {
                $member->role = $role;
                $member->save();
                $this->removeInvitation($idea, $user);
                DiscussionService::addParticipant($idea->discussions->first(), $user);
                return $member;
            } else {
                return null;
            }
        }
        DiscussionService::addParticipant($idea->discussions->first(), $user);
        self::removeInvitation($idea, $user);
        return IdeaMember::create(['user_id' => $user->id, 'idea_id' => $idea->id, 'role' => $role]);
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
        $unlike = Like::onlyTrashed()->where('user_id', $user->id)->where('idea_id', $idea->id)->first();
        if ($unlike) {
            $unlike->restore();
            return $unlike;
        }
        return Like::create(['user_id' => $user->id, 'idea_id' => $idea->id]);
    }

    public static function unlike(Idea $idea, User $user)
    {
        $like = Like::where('user_id', $user->id)->where('idea_id', $idea->id)->first();
        if ($like) {
            $like->delete();
        }
        return $like;
    }
}
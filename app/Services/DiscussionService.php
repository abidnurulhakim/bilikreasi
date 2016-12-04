<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\Discussion;
use App\Models\DiscussionParticipant;
use App\Models\Message;
use App\Models\User;

class DiscussionService
{
    public static function create(Idea $idea, $name = null)
    {
        if (is_null($name)) {
            $name = $idea->title;
        }
        $discussion = new Discussion();
        $discussion->idea_id = $idea->id;
        $discussion->name = $name;
        if ($discussion->save()) {
            return $discussion;
        }
        return null;
    }

    public static function sendMessage(Discussion $discussion, User $user, $content = '')
    {
        $message = new Message();
        $message->discussion_id = $discussion->id;
        $message->user_id = $user->id;
        $message->content = $content;
        if ($message->save()) {
            return $message;
        }
        return null;
    }

    public static function addParticipant(Discussion $discussion, User $user)
    {
        $participant = DiscussionParticipant::where('discussion_id', $discussion->id)
                        ->where('user_id', $user->id)
                        ->first();
        if ($participant) {
            return $participant;
        }
        $participant = DiscussionParticipant::onlyTrashed()
                        ->where('discussion_id', $discussion->id)
                        ->where('user_id', $user->id)
                        ->first();
        if ($participant) {
            if ($participant->restore()) {
                $participant->join_at = \Carbon::now();
                $participant->last_read = \Carbon::now();
                $participant->save();
                return $participant;
            } else {
                return null;
            }
        }
        return DiscussionParticipant::create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'join_at' => \Carbon::now(),
            'last_read' => \Carbon::now()
            ]);
    }

    public static function markAsRead(Discussion $discussion, User $user)
    {
        $discussionParticipant = DiscussionParticipant::whereDiscussionId($discussion->id)->whereUserId($user->id)->firstOrFail();
        $discussionParticipant->last_read = \Carbon::now();
        $discussionParticipant->unread_count = 0;
        return $discussionParticipant->save();
    }

    public static function getAllMessage(Discussion $discussion)
    {
        return $discussion->messages;
    }

    public static function getUnreadMessages(Discussion $discussion, User $user)
    {
        $discussionParticipant = $discussion->participants()->whereUserId($user->id)->firstOrFail();
        self::markAsRead($discussion, $user);
        return $discussion->messages()->where('created_at', '>=', $discussionParticipant->pivot->last_read)->get();
    }
}
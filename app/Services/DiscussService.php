<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\Discuss;
use App\Models\Message;
use App\Models\User;

class DiscussService
{
    public static function create(Idea $idea, $name = null)
    {
        if (is_null($name)) {
            $name = $idea->title;
        }
        $discuss = new Discuss();
        $discuss->idea_id = $idea->id;
        $discuss->name = $name;
        if ($discuss->save()) {
            return $discuss;
        }
        return null;
    }

    public static function sendMessage(Discuss $discuss, User $user, $content = '')
    {
        $message = new Message();
        $message->discuss_id = $discuss->id;
        $message->user_id = $user->id;
        $message->content = $content;
        if ($message->save()) {
            return $message;
        }
        return null;
    }
}
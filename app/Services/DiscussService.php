<?php

namespace App\Services;

use App\Models\Idea;
use App\Models\Discuss;

class DiscussService
{
    public static function create(Idea $idea, $name = $idea->title)
    {
        $discuss = new Discuss();
        $discuss->idea_id = $idea->id;
        $discuss->name = $name;
        if ($discuss->save()) {
            return $discuss;
        }
        return null;
    }
}
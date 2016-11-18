<?php

namespace App\Models;

use App\Models\BaseModel;

class IdeaInvitation extends BaseModel
{
    protected $table = 'idea_invitations';
    protected $fillable = [
        'user_id', 'idea_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

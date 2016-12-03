<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\User;

class Message extends BaseModel
{
    protected $table = 'messages';
    protected $fillable = [
        'user_id', 'discuss_id', 'content', 'type'
    ];

    protected $touches = ['discuss'];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function discuss()
    {
        return $this->belongsTo('App\Models\Discuss', 'discuss_id');
    }

    public function scopeLast($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function isOwner(User $user)
    {
        return $user->id == $this->user_id;
    }

    public function getContentAttribute($value)
    {
        return nl2br(htmlspecialchars($value));
    }
}

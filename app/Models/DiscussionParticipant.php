<?php

namespace App\Models;

use App\Models\BaseModel;

class DiscussionParticipant extends BaseModel
{
    protected $table = 'discussion_participants';
    protected $fillable = [
        'discussion_id', 'user_id', 'join_at', 'unread_count', 'last_read'
    ];
    protected $dates = [
    	'join_at',
    	'last_read',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public static function boot()
    {
    	parent::boot();
        static::creating(function ($participant) {
            $participant->join_at = \Carbon::now();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Models\Discussion', 'discussion_id');
    }
}

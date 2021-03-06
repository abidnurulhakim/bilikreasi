<?php

namespace App\Models;

use App\Models\BaseModel;

class Comment extends BaseModel
{
    protected $table = 'comments';
    protected $fillable = [
        'user_id', 'idea_id', 'content'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::created(function ($comment) {
            $idea = $comment->idea();
            $idea->increment('comment_count');
        });
        static::deleted(function ($comment) {
            $idea = $comment->idea();
            $idea->decrement('comment_count');
        });
        static::restored(function ($comment) {
            $idea = $comment->idea();
            $idea->increment('comment_count');
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

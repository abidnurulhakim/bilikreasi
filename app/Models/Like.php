<?php

namespace App\Models;

use App\Models\BaseModel;

class Like extends BaseModel
{
    protected $table = 'likes';
    protected $fillable = [
        'user_id', 'idea_id'
    ];

    public static function boot()
    {
        static::created(function ($like) {
            $idea = $like->idea();
            $idea->increment('like_count');
        });
        static::deleted(function ($like) {
            $idea = $like->idea();
            $idea->decrement('like_count');
        });
        static::restored(function ($like) {
            $idea = $like->idea();
            $idea->increment('like_count');
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

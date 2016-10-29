<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';
    protected $fillable = [
        'user_id', 'idea_id', 'content'
    ];

    public function boot()
    {
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

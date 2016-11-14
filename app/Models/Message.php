<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'messages';
    protected $fillable = [
        'user_id', 'discuss_id', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function discuss()
    {
        return $this->belongsTo('App\Models\Discuss', 'discuss_id');
    }
    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

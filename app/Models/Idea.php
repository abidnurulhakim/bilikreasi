<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Idea extends Model
{
    use SoftDeletes;
	
    protected $table = 'ideas';
    protected $fillable = [
        'user_id', 'name', 'description', 'type', 'cover'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function discusses()
    {
        return $this->hasMany('App\Models\Discuss', 'idea_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes', 'idea_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'idea_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'members', 'idea_id', 'user_id');
    }

    public function cover()
    {
        return $this->hasOne('App\Models\Attachment', 'id', 'cover')->first()->url;
    }

    public function isMember(App\Models\User $user)
    {
    	is_empty($this->members()->where('user_id', $user->id)->first());
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'confirmed', 'role', 'last_login_at', 'last_login_ip_address', 'birthday'
    ];
    protected $hidden = [
        'password', 'reset_password',
    ];

    public function photo_profile()
    {
        return $this->hasOne('App\Models\Attachment', 'id', 'photo_profile')->first()->url;
    }

    public function ideas()
    {
        return $this->hasMany('App\Models\Idea', 'user_id');
    }

    public function comments(App\Model\Idea $idea = null)
    {
        $query = $this->hasMany('App\Models\Comment', 'user_id');
        if (is_empty($idea)) {
            return $query
        }
        return $query->where('idea_id', $idea->id);
    }

    public function likes(App\Model\Idea $idea = null)
    {
        $query = $this->hasMany('App\Models\Like', 'user_id');
        if (is_empty($idea)) {
            return $query
        }
        return $query->where('idea_id', $idea->id);
    }

    public function memberOf()
    {
        return $this->belongsToMany('App\Models\Idea', 'members', 'user_id', 'idea_id');
    }

    public function messages(App\Model\Discuss $discuss = null)
    {
        $query = $this->hasMany('App\Models\Message', 'user_id');
        if (is_empty($discuss)) {
            return $query
        }
        return $query->where('discuss_id', $discuss->id);
    }

    public function isAdmin()
    {
        $this->role == 'admin';
    }
}

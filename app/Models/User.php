<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\AttachableTrait;

class User extends Authenticatable
{
    use AttachableTrait, SoftDeletes;

    protected $table = 'users';
    public $attachmentable = [
        'photo'
    ];
    protected $fillable = [
        'name', 'email', 'password', 'confirmed', 'role', 'last_login_at',
        'last_login_ip_address', 'birthday', 'username', 'gender', 'photo',
        'password', 'phone_number', 'profession', 'live_at'
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
            return $query;
        }
        return $query->where('idea_id', $idea->id);
    }

    public function likes(App\Model\Idea $idea = null)
    {
        $query = $this->hasMany('App\Models\Like', 'user_id');
        if (is_empty($idea)) {
            return $query;
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
            return $query;
        }
        return $query->where('discuss_id', $discuss->id);
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isMale()
    {
        return empty($this->gender) || $this->gender == 'male';
    }

    public function isFemale()
    {
        return $this->gender == 'female';
    }

    public function getBirthdayAttribute($value)
    {
        if (is_null($value)) return \Carbon\Carbon::now()->toDateString();
        return $value;
    }

    public function skills()
    {
        return $this->hasMany('App\Models\UserSkill', 'user_id');
    }

    public function interests()
    {
        return $this->hasMany('App\Models\UserInterest', 'user_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }
}

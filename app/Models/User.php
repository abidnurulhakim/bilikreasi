<?php

namespace App\Models;

use App\Models\Discuss;
use App\Models\Idea;
use App\Models\Member;
use App\Models\Traits\AttachableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::bootAttachableTrait();
        static::creating(function($idea){
            $idea->confirmed = true;
        });
    }

    public function ideas()
    {
        return $this->hasMany('App\Models\Idea', 'user_id');
    }

    public function comments(Idea $idea = null)
    {
        $query = $this->hasMany('App\Models\Comment', 'user_id');
        if (is_empty($idea)) {
            return $query;
        }
        return $query->where('idea_id', $idea->id);
    }

    public function likes(Idea $idea = null)
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

    public function messages(Discuss $discuss = null)
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

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function invitations()
    {
        return $this->hasMany('App\Models\IdeaInvitation', 'user_id');
    }

    public static function search($keyword = '', $filter = [])
    {
        $words = explode(" ", $keyword);
        $query = self::query();
        foreach ($words as $word) {
            $query = $query->orWhere('name', 'like', '%'.$word.'%');
        }
        foreach ($filter as $key => $value) {
            if ($key = 'not_member_idea') {
                $user_ids = Member::where('idea_id', $value)
                                    ->select('user_id')
                                    ->get()
                                    ->map(function($member) {
                                        return $member->user_id; })
                                    ->toArray();
                $query = $query->whereNotIn('id', $user_ids);
            } else {
                if (is_array($value)) {
                    $query = $query->whereIn($key, $value);
                } else {
                    $query = $query->where($key, $value);
                }    
            }
        }
        return $query;
    }
}

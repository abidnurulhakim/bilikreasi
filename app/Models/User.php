<?php

namespace App\Models;

use App\Models\Discussion;
use App\Models\Idea;
use App\Models\IdeaMember;
use App\Models\Skill;
use App\Models\Interest;
use App\Models\Traits\AttachableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\SluggableTrait;

class User extends Authenticatable
{
    use AttachableTrait, SoftDeletes, SluggableTrait;

    const TYPE = [
        'admin' => 'Admin',
        'user' => 'User'
    ];

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'secret_password', 'hash_password',
        'confirmed', 'role', 'last_login_at', 'last_login_ip_address',
        'birthday', 'username', 'gender', 'photo','phone_number',
        'profession', 'live_at', 'skills', 'interests',
        'confirmation_token', 'about'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'skills' => 'array',
        'interests' => 'array',
    ];

    public $attachmentable = [
        'photo' =>  [
                    'path' => [
                        'crop' => 'storage/attachments/crops',
                        'storage' => 'attachments'
                        ],
                    'default' => 'assets/images/user.jpg'
        ]
    ];
    public $sluggable = [
        'username' => 'name'
    ];

    public static function boot()
    {
        parent::boot();
        static::bootAttachableTrait();
        static::creating(function($user){
            $user->confirmation_token = str_random(66);
        });
        static::saving(function($user){
            if (!is_array($user->skills) ) {
                $skills = explode(',', $user->skills);
                $user->skills = [];
                foreach ($skills as $skill) {
                    if (!empty($skill)) {
                        array_push($user->skills, $skill);
                    }
                }
            }
            if (!is_array($user->interests) ) {
                $interests = explode(',', $user->interests);
                $user->interests = [];
                foreach ($interests as $interest) {
                    if (!empty($interest)) {
                        array_push($user->sinterests, $interest);
                    }
                }
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function ideas()
    {
        return $this->hasMany('App\Models\Idea', 'user_id');
    }

    public function discussions()
    {
        return $this->belongsToMany('App\Models\Discussion', 'discussion_participants', 'user_id', 'discussion_id')
                    ->withPivot('join_at', 'last_read', 'unread_count');
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
        return $this->belongsToMany('App\Models\Idea', 'idea_members', 'user_id', 'idea_id');
    }

    public function messages(Discussion $discuss = null)
    {
        $query = $this->hasMany('App\Models\Message', 'user_id');
        if (is_empty($discuss)) {
            return $query;
        }
        return $query->where('discussion_id', $discuss->id);
    }

    public function invitations()
    {
        return $this->hasMany('App\Models\IdeaInvitation', 'user_id');
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isMale()
    {
        return $this->gender == 'male';
    }

    public function isFemale()
    {
        return $this->gender == 'female';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['secret_password'] = encrypt($value);
        $this->attributes['hash_password'] = \Hash::make($value);
    }

    public function getPasswordAttribute($value)
    {
        return $this->hash_password;
    }

    public static function search($keyword = '', $filter = [])
    {
        $query = self::query();
        if (strlen(trim($keyword)) > 0) {
            $words = preg_split('/\s+/', trim($keyword));
            $query = $query->where(function($q) use ($words) {
                foreach ($words as $word) {
                    $q = $q->orWhere('name', 'like', '%'.$word.'%');
                }
            });
        }
        foreach ($filter as $key => $value) {
            if ($key == 'not_member_idea') {
                $user_ids = IdeaMember::where('idea_id', $value)
                                    ->select('user_id')
                                    ->get()
                                    ->map(function($member) {
                                        return $member->user_id; })
                                    ->toArray();
                $query = $query->whereNotIn('id', $user_ids);
            } else {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        $words = preg_split('/\s+/', trim($val));
                        $query = $query->where(function($q) use ($key, $words) {
                            foreach ($words as $word) {
                                $q = $q->orWhere($key, 'like', '%'.$word.'%');
                            }
                        });
                    }
                } else {
                    $words = preg_split('/\s+/', trim($value));
                    $query = $query->where(function($q) use ($key, $words) {
                        foreach ($words as $word) {
                            $q = $q->orWhere($key, 'like', '%'.$word.'%');
                        }
                    });
                }    
            }
        }
        return $query;
    }
}

<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Member;
use App\Models\User;
use App\Models\IdeaTag;
use App\Models\Traits\AttachableTrait;
use App\Models\Traits\SluggableTrait;

class Idea extends BaseModel
{
    use AttachableTrait, SluggableTrait;

    const CATEGORY = [
        'business' => 'Usaha Profitable (Bisnis Mikro, Startup, dll)',
        'campaign' => 'Aksi/Gerakan/Campaign',
        'community' => 'Komunitas/Kelompok Sosial/Organisasi',
        'project' => 'Proyek/Riset',
        'event' => 'Acara',
        'other' => 'Lainnya'
    ];

    const STATUS = [
        'ready' => 'Mulai',
        'ongoing' => 'Berlangsung',
        'finish' => 'Selesai',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_at',
        'finish_at'
    ];

    protected $table = 'ideas';
    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'type', 'cover', 'category', 'status', 'location', 'start_at', 'finish_at',
        'tags_idea'
    ];
    public $attachmentable = [
        'cover'
    ];
    public $sluggable = [
        'slug' => 'title'
    ];


    public static function boot()
    {
        static::bootAttachableTrait();
        static::bootSluggableTrait();
        static::created(function($idea){
            Member::create(['user_id' => $idea->user_id, 'idea_id' => $idea->id, 'role' => 'admin']);
        });
        static::saving(function($idea){
            if ($idea->category != 'event') {
                $idea->start_at = null;
                $idea->finish_at = null;
            }
        });
    }
    
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
        return $this->hasMany('App\Models\Like', 'idea_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'idea_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'members', 'idea_id', 'user_id')->withPivot('join_at', 'role');
    }

    public function media()
    {
        return $this->hasMany('App\Models\IdeaMedia', 'idea_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\IdeaTag', 'idea_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isAdmin(User $user = null)
    {
        if (is_null($user)) {
            return false;
        }
        $user = $this->members()->find($user->id);
        if ($user) {
            return $user->pivot->role == 'admin';
        }
        return false;
    }

    public function isMember(User $user = null)
    {
        if (is_null($user)) {
            return false;
        }
        return !empty($this->members()->find($user->id));
    }

    public function hasLike(User $user = null)
    {
        if (is_null($user)) {
            return false;
        }
        return !empty($this->members()->find($user->id));
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = htmlspecialchars($value);
    }

    public function getDescriptionAttribute($value)
    {
        return htmlspecialchars_decode($value);
    }

    public function setStartAtAttribute($value)
    {
        $value = trim($value);
        if (!empty($value) && !is_null($value)) {
            $this->attributes['start_at'] = \Carbon::createFromFormat('m/d/Y g:i A', $value);
        }
    }

    public function setFinishAtAttribute($value)
    {
        $value = trim($value);
        if (!empty($value) && !is_null($value)) {
            $this->attributes['finish_at'] = \Carbon::createFromFormat('m/d/Y g:i A', $value);
        }
    }

    public static function search($keyword = '', $filter = [])
    {
        $words = explode(" ", $keyword);
        $query = self::query();
        foreach ($words as $word) {
            $query = $query->orWhere('title', 'like', '%'.$word.'%');
        }
        foreach ($filter as $key => $value) {
            if ($key == 'tag') {
                $tags = IdeaTag::whereIn('name', $value)
                            ->distinct()
                            ->select('idea_id')
                            ->get()
                            ->sortBy('idea_id')
                            ->map(function($tag) {
                                return $tag->idea_id; })
                            ->toArray();
                $query = $query->whereIn('id', $tags);
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

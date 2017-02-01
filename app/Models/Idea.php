<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\IdeaInvitation;
use App\Models\Like;
use App\Models\User;
use App\Services\IdeaService;
use App\Services\DiscussionService;
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
        'ready' => 'Persiapan',
        'ongoing' => 'Berlangsung',
        'finish' => 'Selesai',
    ];

    protected $table = 'ideas';

    protected $fillable = [
        'user_id', 'title', 'slug', 'description',
        'type', 'cover', 'category', 'status',
        'location', 'start_at', 'finish_at', 'tags',
        'viewer_count', 'member_count', 'like_count'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_at',
        'finish_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'array',
    ];

    public $attachmentable = [
        'cover' =>  [
                    'path' => [
                        'crop' => 'storage/attachments/crops',
                        'storage' => 'attachments'
                    ],
                    'default' => 'assets/images/idea.jpg'
        ]
    ];
    public $sluggable = [
        'slug' => 'title'
    ];


    public static function boot()
    {
        parent::boot();
        
        static::bootAttachableTrait();
        static::bootSluggableTrait();
        static::saved(function($idea){
            if (strlen($idea->title) && $idea->discussions()->count() == 0) {
                $discussion = DiscussionService::create($idea);
                IdeaService::join($idea, $idea->user, 'admin');
                DiscussionService::addParticipant($discussion, $idea->user);
            }
        });
        static::saving(function($idea){
            if ($idea->category != 'event') {
                $idea->start_at = null;
                $idea->finish_at = null;
            }
            if (!is_array($idea->tags) ) {
                $tags = explode(',', $idea->tags);
                $idea->tags = [];
                foreach ($tags as $tag) {
                    if (!empty($tag)) {
                        array_push($idea->tags, $tag);
                    }
                }
            }
        });
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function discussions()
    {
        return $this->hasMany('App\Models\Discussion', 'idea_id');
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
        return $this->belongsToMany('App\Models\User', 'idea_members', 'idea_id', 'user_id')->withPivot('join_at', 'role');
    }

    public function media()
    {
        return $this->hasMany('App\Models\IdeaMedia', 'idea_id');
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
        if (is_string($value) && !empty($value) && !is_null($value)) {
            $this->attributes['start_at'] = \Carbon::createFromFormat('d/m/Y h:i', trim($value));
        } else {
            $this->attributes['start_at'] = $value;
        }
    }

    public function setFinishAtAttribute($value)
    {
        if (is_string($value) && !empty($value) && !is_null($value)) {
            $this->attributes['finish_at'] = \Carbon::createFromFormat('d/m/Y h:i', trim($value));
        } else {
            $this->attributes['finish_at'] = $value;
        }
    }

    public function invitations()
    {
        return $this->hasMany('App\Models\IdeaInvitation', 'idea_id');
    }

    public function hasInvite(User $user = null)
    {
        if (is_null($user)) {
            return false;
        }
        return IdeaInvitation::where('idea_id', $this->id)->where('user_id', $user->id)->count() > 0;
    }

    public function hasLike(User $user = null)
    {
        if (is_null($user)) {
            return false;
        }
        return Like::where('idea_id', $this->id)->where('user_id', $user->id)->count() > 0;
    }

    public static function search($keyword = '', $filter = [])
    {
        $query = self::query();
        if (strlen(trim($keyword)) > 0) {
            $words = preg_split('/\s+/', trim($keyword));
            $query = $query->where(function($q) use ($words) {
                foreach ($words as $word) {
                    $q = $q->orWhere('title', 'like', '%'.$word.'%');
                }
            });
        }
        foreach ($filter as $key => $value) {
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
        return $query;
    }
}

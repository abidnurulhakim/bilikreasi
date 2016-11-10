<?php

namespace App\Models;

use App\Models\Member;
use App\Models\User;
use App\Models\Traits\AttachableTrait;
use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Idea extends Model
{
    use AttachableTrait, SluggableTrait, SoftDeletes;

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

    protected $table = 'ideas';
    public $attachmentable = [
        'cover'
    ];
    public $sluggable = [
        'slug' => 'title'
    ];
    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'type', 'cover', 'category', 'status', 'location'
    ];


    public static function boot()
    {
        static::bootAttachableTrait();
        static::bootSluggableTrait();
        static::created(function($idea){
            Member::create(['user_id' => $idea->user_id, 'idea_id' => $idea->id, 'role' => 'admin']);
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
        return $this->hasMany('App\Models\Likes', 'idea_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'idea_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'members', 'idea_id', 'user_id')->withPivot('join_at', 'role');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\IdeaPhoto', 'idea_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\IdeaTag', 'idea_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isAdmin(User $user)
    {
        return $this->members()->find($user->id)->pivot->role == 'admin';
    }

    public function isMember(User $user)
    {
        return !empty($this->members()->find($user->id));
    }
}

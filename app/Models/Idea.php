<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\AttachableTrait;
use App\Models\Traits\SluggableTrait;

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
        'photo'
    ];
    public $sluggable = [
        'slug' => 'title'
    ];
    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'type', 'cover', 'category', 'status'
    ];


    public static function boot()
    {
        static::bootAttachableTrait();
        static::bootSluggableTrait();
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
        return $this->belongsToMany('App\Models\User', 'members', 'idea_id', 'user_id');
    }

    public function isMember(App\Models\User $user)
    {
    	is_empty($this->members()->where('user_id', $user->id)->first());
    }

    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'idea_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\IdeaTag', 'idea_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

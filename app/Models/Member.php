<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $table = 'members';
    protected $fillable = [
        'user_id', 'idea_id', 'join_at'
    ];

    public function boot()
    {
        static::creating(function ($member) {
            $member->join_at = Carbon\Carbon::now();
        });
        static::created(function ($member) {
            $idea = $member->idea();
            $idea->increment('member_count');
        });
        static::deleted(function ($member) {
            $idea = $member->idea();
            $idea->decrement('member_count');
        });
        static::restoring(function ($member) {
            $member->join_at = Carbon\Carbon::now();
        });
        static::restored(function ($member) {
            $idea = $member->idea();
            $idea->increment('member_count');
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

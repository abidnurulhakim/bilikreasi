<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Interest;

class UserInterest extends BaseModel
{
    protected $table = 'user_interests';
    protected $fillable = [
        'user_id', 'name'
    ];

    public static function boot()
    {        
        parent::boot();
        
        static::saved(function ($userInterest) {
            if (Interest::where('name', $userInterest->name)->count() == 0) {
                $interest = new Interest();
                $interest->name = $userInterest->name;
                $interest->publish = true;
                $interest->save();
            }
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Interest;

class UserInterest extends Model
{
    
    use SoftDeletes;

    protected $table = 'user_interests';

    protected $fillable = [
        'user_id', 'name'
    ];

    public static function boot()
    {        
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
}

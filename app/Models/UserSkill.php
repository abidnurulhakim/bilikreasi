<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Skill;

class UserSkill extends Model
{
    
    use SoftDeletes;

    protected $table = 'user_skills';

    protected $fillable = [
        'user_id', 'name'
    ];

    public static function boot()
    {        
        static::saved(function ($userSkill) {
            if (Skill::where('name', $userSkill->name)->count() == 0) {
                $skill = new Skill();
                $skill->name = $userSkill->name;
                $skill->publish = true;
                $skill->save();
            }
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

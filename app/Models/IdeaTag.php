<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag;

class IdeaTag extends Model
{
    
    use SoftDeletes;

    protected $table = 'idea_tags';

    protected $fillable = [
        'idea_id', 'name'
    ];

    public static function boot()
    {        
        static::saved(function ($ideaTag) {
            if (Tag::where('name', $ideaTag->name)->count() == 0) {
                $tag = new Tag();
                $tag->name = $ideaTag->name;
                $tag->save();
            }
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}

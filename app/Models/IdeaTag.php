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
            $idea = $ideaTag->idea;
            if (!in_array($ideaTag->name, $idea->tags_idea)) {
                $tags = $idea->tags_idea;
                array_push($tags, $ideaTag->name);
                $idea->tags_idea = $tags;
                $idea->save();
            }
        });
        static::deleted(function ($ideaTag) {
            $idea = $ideaTag->idea;
            $idea->tags_idea = array_diff($idea->tags_idea, array($ideaTag->name));
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

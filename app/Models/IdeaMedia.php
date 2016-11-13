<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\AttachableTrait;

class IdeaMedia extends Model
{
    use AttachableTrait, SoftDeletes;

    protected $table = 'idea_media';
    public $attachmentable = [
        'url'
    ];
    protected $fillable = [
        'idea_id', 'url', 'type'
    ];

    public static function boot()
    {
        static::bootAttachableTrait();
        static::creating(function($ideaMedia){
            $mime = mime_content_type($ideaMedia->url);
            if(strstr($mime, "video/")){
                $ideaMedia->type = 'video';
            }else if(strstr($mime, "image/")){
                $ideaMedia->type = 'image';
            } else {
                $ideaMedia->type = 'file';
            }
        });
        static::saving(function($ideaMedia){
            $mime = mime_content_type($ideaMedia->url);
            if(strstr($mime, "video/")){
                $ideaMedia->type = 'video';
            }else if(strstr($mime, "image/")){
                $ideaMedia->type = 'image';
            } else {
                $ideaMedia->type = 'file';
            }
        });
    }

    public function idea()
    {
    	return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
    
}

<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\AttachableTrait;

class IdeaMedia extends BaseModel
{
    use AttachableTrait;

    protected $table = 'idea_media';
    public $attachmentable = [
        'url' => 'assets/images/idea.jpg'
    ];
    protected $fillable = [
        'idea_id', 'url', 'type'
    ];

    public static function boot()
    {
        parent::boot();
        
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

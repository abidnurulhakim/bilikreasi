<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\AttachableTrait;

class IdeaMedia extends BaseModel
{
    use AttachableTrait;

    protected $table = 'idea_media';
    public $attachmentable = [
        'url' =>[
                'path' => [
                    'crop' => 'storage/attachments/crops',
                    'storage' => 'attachments'
                ],
                'default' => 'assets/images/idea.jpg'
        ]
    ];
    protected $fillable = [
        'idea_id', 'url', 'type'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::bootAttachableTrait();
        static::creating(function($ideaMedia){
            if (!is_string($ideaMedia->url)) {
                $mime = mime_content_type($ideaMedia->url);
                if(strstr($mime, "video/")){
                    $ideaMedia->type = 'video';
                }else if(strstr($mime, "image/")){
                    $ideaMedia->type = 'image';
                } else {
                    $ideaMedia->type = 'file';
                }
            }
        });
        static::deleted(function($ideaMedia){
            $name = basename($ideaMedia->url);
            array_map('unlink', glob($ideaMedia->attachmentable['url']['path']['crop']."/".$name.'-*'));
            if ($ideaMedia->url != $ideaMedia->attachmentable['url']['default']) {
                unlink($ideaMedia->url);
            }
        });
    }

    public function idea()
    {
    	return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
    
}

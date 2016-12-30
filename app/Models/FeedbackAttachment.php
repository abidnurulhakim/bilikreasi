<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\AttachableTrait;

class FeedbackAttachment extends BaseModel
{
    use AttachableTrait;

    protected $table = 'feedback_attachments';
    protected $fillable = [
        'feedback_id', 'url'
    ];

    public $attachmentable = [
        'url' =>[
                'path' => [
                    'crop' => 'storage/attachments/crops',
                    'storage' => 'attachments'
                ],
                'default' => null
        ]
    ];

    public static function boot()
    {
        parent::boot();
        
        static::bootAttachableTrait();
    }

    public function feedback()
    {
        return $this->belongsTo('App\Models\Feedback', 'feedback_id');
    }
}

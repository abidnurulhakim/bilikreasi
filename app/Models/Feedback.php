<?php

namespace App\Models;

use App\Models\BaseModel;

class Feedback extends BaseModel
{
    const STATUS = [
        'unread',
        'replied',
        'read',
    ];

    protected $table = 'feedbacks';
    protected $fillable = [
        'name', 'email', 'subject', 'content',
        'status'
    ];

    public function attachments()
    {
        return $this->hasMany('App\Models\FeedbackAttachment', 'feedback_id');
    }
}

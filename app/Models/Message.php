<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\DiscussionParticipant;
use App\Models\User;
use App\Models\Traits\AttachableTrait;

class Message extends BaseModel
{
    use AttachableTrait;

    protected $table = 'messages';
    protected $fillable = [
        'user_id', 'discussion_id', 'content', 'type'
    ];
    protected $touches = ['discussion'];

    public $attachmentable = [
        'content' =>  [
                    'path' => [
                        'crop' => 'storage/attachments/crops',
                        'storage' => 'attachments'
                    ],
                    'default' => 'assets/images/idea.jpg'
        ]
    ];
    public static function boot()
    {
        parent::boot();
        
        static::bootAttachableTrait();
        static::creating(function($message){
            if (gettype($message->content) == 'object') {
                $extension = $message->content->extension();
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $videoExtensions = ['mp4', 'flv', '3gp'];
                if (in_array($extension, $imageExtensions)) {
                    $message->type = 'image';
                } else if (in_array($extension, $videoExtensions)) {
                    $message->type = 'video';
                } else {
                    $message->type = 'file';
                }
            } else {
                $message->type = 'text';
            }
        });
        static::created(function($message){
            $participants = DiscussionParticipant::whereDiscussionId($message->discussion_id)->get();
            foreach ($participants as $participant) {
                $participant->increment('unread_count');
                $participant->save();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Models\Discussion', 'discussion_id');
    }

    public function scopeLast($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function isOwner(User $user)
    {
        return $user->id == $this->user_id;
    }

    public function getContentAttribute($value)
    {
        return nl2br(htmlspecialchars($value));
    }
}

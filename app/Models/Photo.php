<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\AttachmentAble;

class Photo extends Model
{
    use SoftDeletes;
    use AttachmentAble;

    protected $table = 'photos';
    protected $attachmentable = [
        'attachment_id'
    ];
    protected $fillable = [
        'idea_id', 'attchment_id'
    ];

    public function idea()
    {
    	return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

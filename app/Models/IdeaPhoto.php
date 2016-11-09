<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\AttachableTrait;

class IdeaPhoto extends Model
{
    use SoftDeletes;
    use AttachableTrait, SoftDeletes;

    protected $table = 'idea_photos';
    public $attachmentable = [
        'url'
    ];
    protected $fillable = [
        'idea_id', 'url'
    ];

    public function idea()
    {
    	return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

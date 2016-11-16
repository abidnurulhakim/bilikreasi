<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\SluggableTrait;

class Interest extends BaseModel
{
    use SluggableTrait;

    protected $table = 'interests';
    public $sluggable = [
        'slug' => 'name'
    ];

    protected $fillable = [
        'name', 'slug', 'publish'
    ];
    
    public function scopePublish($query)
    {
        return $query->where('publish', true);
    }
}

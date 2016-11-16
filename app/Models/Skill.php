<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\SluggableTrait;

class Skill extends BaseModel
{
    use SluggableTrait;

    protected $table = 'skills';
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

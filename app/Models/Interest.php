<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\SluggableTrait;

class Interest extends Model
{
    
    use SoftDeletes;
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

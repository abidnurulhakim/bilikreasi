<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;

class Popular extends BaseModel
{
    use SluggableTrait;

    protected $table = 'populars';
    protected $fillable = [
        'title', 'slug', 'publish', 'order_number'
    ];
    
    public $sluggable = [
        'slug' => 'title'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function($popular){
            if (is_null($popular->order_number) || $popular->order_number < 0) {
                $popular->order_number = \App\Models\Popular::publish()->count() + 1;
            } elseif ($popular->order_number == 0) {
                $popular->order_number = 1;
            } 
        });
        static::addGlobalScope('order_popular', function (Builder $builder) {
            $builder->orderBy('order_number', 'asc');
        });
        static::bootSluggableTrait();
    }
    
    public function scopePublish($query)
    {
    	return $query->where('publish', true);
    }

    public function ideas()
    {
    	return $this->belongsToMany('App\Models\Idea', 'popular_ideas', 'popular_id', 'idea_id')->withPivot('id', 'order_number');;
    }
}

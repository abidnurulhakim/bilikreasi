<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\SluggableTrait;

class PopularIdea extends BaseModel
{
    protected $table = 'popular_ideas';
    protected $fillable = [
        'popular_id', 'idea_id', 'publish', 'order_number'
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
        static::addGlobalScope('order_banner', function (Builder $builder) {
            $builder->order('order_number', 'asc');
        });
        static::bootAttachableTrait();
        static::bootSluggableTrait();
    }
    
    public function scopePublish($query)
    {
    	return $query->where('publish', true);
    }

    public function idea()
    {
    	return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

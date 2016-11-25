<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;

class PopularIdea extends BaseModel
{
    protected $table = 'popular_ideas';
    protected $fillable = [
        'popular_id', 'idea_id', 'publish', 'order_number'
    ];
    
    public static function boot()
    {
        parent::boot();
        
        static::creating(function($popularIdea){
            if (is_null($popularIdea->order_number) || $popularIdea->order_number < 0) {
                $popularIdea->order_number = 
                    \App\Models\PopularIdea::where('popular_id', $popularIdea->popular_id)
                    ->groupBy(['popular_id',])->count() + 1;
            } elseif ($popularIdea->order_number == 0) {
                $popularIdea->order_number = 1;
            } 
        });
        static::addGlobalScope('order_popular_idea', function (Builder $builder) {
            $builder->orderBy('order_number', 'asc');
        });
    }
    
    public function idea()
    {
    	return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}

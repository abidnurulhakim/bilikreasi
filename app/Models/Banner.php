<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\AttachableTrait;
use App\Models\Traits\SluggableTrait;

class Banner extends BaseModel
{
    use AttachableTrait, SluggableTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_at',
        'finish_at'
    ];

    protected $table = 'banners';
    protected $fillable = [
        'title', 'slug', 'description', 'url', 'image', 'start_at', 'finish_at',
        'publish', 'order_number'
    ];
    public $attachmentable = [
        'image' => 'assets/images/idea.jpg'
    ];
    public $sluggable = [
        'slug' => 'title'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function($banner){
            if (is_null($banner->order_number) || $banner->order_number < 0) {
                $banner->order_number = \App\Models\Banner::publish()->count() + 1;
            } elseif ($banner->order_number == 0) {
                $banner->order_number = 1;
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
        return $query->where('publish', true)->where('start_at', '>=', \Carbon::now())->where('finish_at', '<=', \Carbon::now());
    }
}

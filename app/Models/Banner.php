<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\AttachableTrait;
use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;

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
        'image' =>  [
                    'path' => [
                        'crop' => 'storage/attachments/crops',
                        'storage' => 'attachments'
                    ],
                    'default' => 'assets/images/idea.jpg'
        ]
    ];
    public $sluggable = [
        'slug' => 'title'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function($banner){
            if (is_null($banner->order_number) || $banner->order_number < 0) {
                $banner->order_number = \App\Models\Banner::publish()->groupBy('order_number')->count() + 1;
            } elseif ($banner->order_number == 0) {
                $banner->order_number = 1;
            } 
        });
        static::bootAttachableTrait();
        static::bootSluggableTrait();
        static::addGlobalScope('order_banner', function (Builder $builder) {
            $builder->orderBy('order_number', 'asc');
        });
    }
    
    public function scopePublish($query)
    {
        return $query->where('publish', true)->where('start_at', '<=', \Carbon::now())->where('finish_at', '>=', \Carbon::now());
    }

    public function setStartAtAttribute($value)
    {
        $value = trim($value);
        if (!empty($value) && !is_null($value)) {
            $this->attributes['start_at'] = \Carbon::createFromFormat('m/d/Y g:i A', $value);
        }
    }

    public function setFinishAtAttribute($value)
    {
        $value = trim($value);
        if (!empty($value) && !is_null($value)) {
            $this->attributes['finish_at'] = \Carbon::createFromFormat('m/d/Y g:i A', $value);
        }
    }
}

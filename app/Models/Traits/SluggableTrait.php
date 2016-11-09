<?php

namespace App\Models\Traits;

trait SluggableTrait
{
    public static function bootSluggableTrait()
    {
        static::creating(function($model){
            foreach ($model->sluggable as $key => $value) {
                if (empty($model->getOriginal($key))) {
                    $codeUnique = static::where($key, str_slug($model->$value, "-"))->count();
                    while ($codeUnique > 0) {
                        $codeUnique = static::where($key, str_slug($model->$value, '-')."-$codeUnique")->count();
                    }
                    if ($codeUnique == 0) {
                        $model->$key = str_slug($model->$value, '-');
                    } else {
                        $model->$key = str_slug($model->$value, '-')."-$codeUnique";
                    }
                }
            }
            
        });
    }
}

?>
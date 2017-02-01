<?php

namespace App\Models\Traits;

trait SluggableTrait
{
    public static function bootSluggableTrait()
    {
        static::creating(function($model) {
            foreach ($model->sluggable as $key => $value) {
                if ($model->isDirty() && empty($model->$key)) {
                    $codeUnique = static::withoutGlobalScopes()->where($key, str_slug($model->$value, "-"))->count($key);
                    while ($codeUnique > 0) {
                        $total = static::withoutGlobalScopes()->where($key, str_slug($model->$value, '-')."-$codeUnique")->count();
                        if ($total == 0) {
                            break;
                        } else {
                            $codeUnique++;
                        }
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

    public function generateSlug($key = '')
    {
        if (empty($key)) {
            $key = key($this->sluggable);
        }
        $textSlug = $this->attributes[$this->sluggable[$key]];
        $codeUnique = static::withoutGlobalScopes()->where($key, str_slug($textSlug, "-"))->count($key);
        while ($codeUnique > 0) {
            $total = static::withoutGlobalScopes()->where($key, str_slug($textSlug, '-')."-$codeUnique")->count();
            if ($total == 0) {
                break;
            } else {
                $codeUnique++;
            }
        }
        if ($codeUnique == 0) {
            $this->$key = str_slug($textSlug, '-');
        } else {
            $this->$key = str_slug($textSlug, '-')."-$codeUnique";
        }       
    }
}

?>
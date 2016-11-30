<?php

namespace App\Models\Traits;

trait AttachableTrait
{
    public static function bootAttachableTrait()
    {
        static::saving(function ($model) {
            if ($model->isDirty()) {
                foreach ($model->attachmentable as $field => $options) {
                    if (gettype($model->$field) == 'object' && get_class($model->$field) == 'Illuminate\Http\UploadedFile') {
                        $fileName = uniqid().'.'.$model->$field->extension();
                        if ($model->$field->storeAs($options['path']['storage'], $fileName, 'public')) {
                            $oldFile = $model->getOriginal($field);
                            $model->$field = 'storage/'.$options['path']['storage'].'/'.$fileName;
                            if (!empty($oldFile)) {
                                $name = basename($model->getOriginal($field));
                                array_map('unlink', glob($options['path']['crop']."/".$name.'-*'));
                                if ($oldFile != $options['default']) {
                                    unlink($oldFile);
                                }
                            }
                        }
                    } elseif (empty($model->$field)) {
                        $model->$field = $options['default'];
                    }
                }
            }            
            
        });
    }

    public function __call($method, $arguments)
    {
        $nameAttr = substr(snake_case($method), 4);
        if (in_array($nameAttr, array_keys($this->attachmentable))) {
            if (!empty($this->getOriginal($nameAttr))) {
                if (!file_exists($this->getOriginal($nameAttr))) {
                    return asset($this->attachmentable[$nameAttr]['default']);
                }
                if (getimagesize($this->getOriginal($nameAttr))) {
                    switch (sizeof($arguments)) {
                        case 0:
                            $width = 300;
                            $height = 300;
                            break;
                        case 1:
                            $width = $arguments[0];
                            $height = $arguments[0];
                            break;
                        case 2:
                            $width = $arguments[0];
                            $height = $arguments[1];
                            break;
                        default:
                            return parent::__call($method, $arguments);
                            break;
                    }
                    $name = basename($this->getOriginal($nameAttr));
                    $ext = pathinfo($this->getOriginal($nameAttr), PATHINFO_EXTENSION);
                    $fileName = $this->attachmentable[$nameAttr]['path']['crop'].'/'.$name.'-'.$width.'x'.$height.'.'.$ext;
                    if (!file_exists($fileName)) {
                        $this->generateImage($this->getOriginal($nameAttr), $fileName, $width, $height);
                    }
                    return asset($fileName);
                }
                return asset($this->getOriginal($nameAttr));
            }
            return parent::__call($method, $arguments);
        } else {
            return parent::__call($method, $arguments);
        }
    }

    private function generateImage($path, $fileName, $width = 300, $height = 300)
    {
        $img = \Image::make($path)->fit($width, $height);
        $img->save($fileName);
    }
}

?>
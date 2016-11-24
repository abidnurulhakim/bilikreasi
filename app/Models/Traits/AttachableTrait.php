<?php

namespace App\Models\Traits;

trait AttachableTrait
{
    public static function bootAttachableTrait()
    {
        static::saving(function ($model) {
            if ($model->isDirty()) {
                foreach ($model->attachmentable as $field => $default) {
                    if (gettype($model->$field) == 'object' && get_class($model->$field) == 'Illuminate\Http\UploadedFile') {
                        $fileName = uniqid().'.'.$model->$field->extension();
                        if ($model->$field->storeAs('attachments', $fileName, 'public')) {
                            $oldFile = $model->getOriginal($field);
                            $model->$field = 'attachments/'.$fileName;
                            if (!empty($oldFile)) {
                                $part = preg_split('~\.(?=[^\.]*$)~', $oldFile);
                                array_map('unlink', glob($part[0].'-*'));
                                unlink($oldFile);
                            }
                        }
                    } elseif (empty($model->$field)) {
                        $model->$field = $default;
                    }
                }
            }            
            
        });
    }

    public function __call($method, $arguments)
    {
        $nameAttr = substr(snake_case($method), 4);
        if (in_array($nameAttr, array_keys($this->attachmentable))) {
            if (!empty($this->getOriginal($nameAttr)) && getimagesize($this->getOriginal($nameAttr))) {
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
                $part = preg_split('~\.(?=[^\.]*$)~', $this->getOriginal($nameAttr));
                if (!file_exists($part[0].'-'.$width.'x'.$height.'.'.$part[1])) {
                    $this->generateImage($this->getOriginal($nameAttr), $part[0].'-'.$width.'x'.$height.'.'.$part[1], $width, $height);
                }
                return asset($part[0].'-'.$width.'x'.$height.'.'.$part[1]);
            }
            return parent::__call($method, $arguments);
        } else {
            return parent::__call($method, $arguments);
        }
    }

    private function generateImage($path, $fileName, $width = 300, $height = 300)
    {
        $img = \Image::make($path)->resize($width, $height);
        $img->save($fileName);
    }
}

?>
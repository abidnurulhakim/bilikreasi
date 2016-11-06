<?php

namespace App\Models\Traits;

trait AttachableTrait
{
    public static function bootAttachableTrait()
    {
        static::saving(function ($model) {            
            foreach ($model->attachmentable as $field) {
                if (get_class($model->$field) == 'Illuminate\Http\UploadedFile') {
                    $fileName = uniqid().'.'.$model->$field->extension();
                    if ($model->$field->move("attachments", $fileName)) {
                        $oldFile = $model->getOriginal($field);
                        $model->$field = "attachments/".$fileName;
                        if (!empty($oldFile)) {
                            $part = preg_split('~\.(?=[^\.]*$)~', $oldFile);
                            array_map('unlink', glob($part[0].'-*'));
                            unlink($oldFile);
                        }
                    }
                }
            }
        });
    }

    public function __call($method, $arguments)
    {
        $nameAttr = substr(snake_case($method), 4);
        if (in_array($nameAttr, $this->attachmentable)) {
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
                $img = \Image::make($this->getOriginal($nameAttr))->resize($width, $height);
                $part = preg_split('~\.(?=[^\.]*$)~', $this->getOriginal($nameAttr));
                $img->save($part[0].'-'.$width.'x'.$height.'.'.$part[1], 100);
                return $part[0].'-'.$width.'x'.$height.'.'.$part[1];
            }
            else {
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
                return 'http://lorempixel.com/'.$width.'/'.$height.'/people/3/';
            }
        } else {
            return parent::__call($method, $arguments);
        }
    }
}

?>
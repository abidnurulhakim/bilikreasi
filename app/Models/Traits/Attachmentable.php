<?php

namespace App\Models\Traits;

trait Attachmentable
{
    public static function bootAttachmentableTrait()
    {
        static::saving(function($item){
            foreach ($this->attachment as $field) {
                $attachmentField = $item->getOriginal($field);
                if (property_exists('Illuminate\Http\UploadedFile', $attachmentField)) {
                    $fileName = uniqid.'.'.$attachment_field->extension();
                    $attachment_field->move("attachments", $fileName);
                    $item->$field = $attachment_field;
                }
            }
        });
    }

    public function __call($method, $arguments)
    {
        $nameAttr = substr(snake_case($method), 4);
        if (in_array($nameAttr, $this->attachment)) {
            if (!empty($this->getOriginal($nameAttr)) && getimagesize($this->getOriginal($nameAttr))) {
                
                switch (sizeof($arguments)) {
                    case 1:
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
        } else {
            return parent::__call($method, $arguments);
        }
    }
}

?>
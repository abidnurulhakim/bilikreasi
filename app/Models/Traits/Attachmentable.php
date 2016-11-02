<?php

namespace App\Models\Traits;

use App\Models\Attachment as Attachment;

trait Attachmentable
{
    public static function bootAttachmentableTrait()
    {
        static::saving(function($item){
            foreach ($attachment_field as $field) {
                $attachment_field = $item->getOriginal($field);
                if (property_exists('Illuminate\Http\UploadedFile', $attachment_field)) {
                    $fileName = uniqid.".".$attachment_field->extension();
                    $attachment_field->move("attachments", $fileName);
                    $attachment = new Attachment();
                    $attachment->url = "attachments/".$fileName;
                    if ($attachments->save()) {
                        $attachment_field = $attachment->id;
                    }
                }
            }
        });
    }


}

?>
<?php

namespace App\Services;

use App\Models\Feedback;
use App\Mail\ReplyFeedback;

class FeedbackService
{
    public static function reply(Feedback $feedback, $reply_content = '')
    {
        \Mail::send(new ReplyFeedback($feedback, $reply_content));
        $feedback->status = 'replied';
        $feedback->save();
    }
}
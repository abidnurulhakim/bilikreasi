<?php

namespace App\Mail;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyFeedback extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;
    public $reply_content;
    public $mailQueue = 'email-reply-feedback';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback, $reply_content)
    {
        $this->feedback = $feedback;
        $this->reply_content = $reply_content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->feedback->email, $this->feedback->name)
            ->subject('[Ticket #'.$this->feedback->id.'] - '.$this->feedback->subject)
            ->from('support@bilikreasi.com', 'Support Bilikreasi')
            ->bcc('support@bilikreasi.com')
            ->view('emails.feedback.reply');
    }
}

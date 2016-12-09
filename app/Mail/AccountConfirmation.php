<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $mailQueue = 'email-register-confirmation';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->name)
            ->subject('Konfirmasi Akun')
            ->view('emails.user.account-confirmation');
    }
}

<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class ConfirmationEmail extends Notification implements ShouldQueue
{
    use Queueable, InteractsWithQueue;

    protected $user;
    protected $broadcastQueue = 'user-notification';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('home.register.confirmation', ['id' => $this->user->id, 'token' => $this->user->confirmation_token]);
        return (new MailMessage)
                    ->greeting('Hai, '.$this->user->name)
                    ->line('Selamat datang di Bilikreasi. Agar kamu dapat membuat ide, mohon konfirmasi akun kamu dengan mengklik tombol tautan di bawah ini.')
                    ->action('Konfirmasi email', $url)
                    ->line('Terima kasih telah mendaftar di Bilikreasi');
    }
}

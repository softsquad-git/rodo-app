<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    public function __construct(public string $token)
    {
        //
    }

    /**
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Zmiana hasła')
            ->line('Otrzymujesz tę wiadomość e-mail, ponieważ otrzymaliśmy prośbę o zresetowanie hasła do Twojego konta.')
            ->action('Resetuj hasło', url('password/reset', $this->token))
            ->line('Jeśli nie zażądałeś zresetowania hasła, nie są wymagane żadne dalsze działania.');
    }

    /**
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserInvitation extends Notification
{
    use Queueable;

    public function __construct(
        private readonly User $user
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/admin/register?token=' . $this->user->invitation_token);

        return (new MailMessage)
            ->line('Voce foi convidado para se registrar no sistema.')
            ->action('Registrar', $url)
            ->line('Obrigado por usar nosso sistema!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

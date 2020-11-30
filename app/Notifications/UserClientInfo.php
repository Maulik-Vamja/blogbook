<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserClientInfo extends Notification
{
    use Queueable;

    public $ip;
    public $browser;
    public $device;
    public $os;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ip,$browser,$device,$os)
    {
        $this->ip = $ip;
        $this->browser = $browser;
        $this->device = $device;
        $this->os = $os;

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
        return (new MailMessage)
                    ->subject('Login Attempts')
                    ->greeting('Hello '.auth()->user()->name)
                    ->line('You Are Attempt Login from ...')
                    ->line('Ip Address is  : '.$this->ip)
                    ->line('Client Browser is : '.$this->browser)
                    ->line('Client Device : '.$this->device)
                    ->line('Client Operating System : '.$this->os)
                    ->line('IF you attempt this login then Ignore This Message')
                    ->line('If You are not Attempt this Login then report it Or Change your Password')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
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

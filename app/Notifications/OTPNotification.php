<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Bitfumes\KarixNotificationChannel\KarixChannel;
use Bitfumes\KarixNotificationChannel\KarixMessage;

class OTPNotification extends Notification
{
    use Queueable;

    protected $OTP;
    protected $purpose;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($OTP, $purpose)
    {
        $this->OTP = $OTP;
        $this->purpose = $purpose;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [KarixChannel::class];//['mail'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
    
    public function toKarix($notifiable)
    {
        return KarixMessage::create()
                        ->from('+919745988646')
                        ->content("Your {$this->purpose} OTP is {$this->OTP}");
    }
}

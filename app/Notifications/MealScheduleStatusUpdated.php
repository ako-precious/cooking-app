<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MealScheduleStatusUpdated extends Notification
{
    use Queueable;

    public $message;
    public $id;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $id)
    {
        $this->message = $message;
        $this->id = $id;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
   
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Meal Order Status Update')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->message)
            ->action('View Order status', url('/cook/order/'. $this->id)) // Assuming there's a route to view the order
            ->line('You are the ingredient that makes Ounjemi special. Thanks for being amazing!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

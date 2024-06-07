<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\Message;
use NotificationChannels\WebPush\WebPushChannel;

class PushNotification extends Notification
{
    use Queueable;

    public $message;
    public $id;

    /**
     * Create a new notification instance.
     *
     * @param string $message
     * @param int $id
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
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param mixed $notifiable
     * @param mixed $notification
     * @return \NotificationChannels\WebPush\Message
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new Message)
            ->title('New Notification')
            ->body($this->message)
            ->icon('./images/logo2.png')
            ->data(['url' => '/cook/order/'. $this->id])
            ->action('View App', 'notification_action');
            
    }
}

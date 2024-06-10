<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $id;

    public function __construct($message, $id)
    {
        $this->message = $message;
        $this->id = $id;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New Notification')
            ->body($this->message)
            ->icon('./images/logo2.png')
            ->data(['url' => '/cook/order/' . $this->id])
            ->action('View App', 'notification_action');
    }
}

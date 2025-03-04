<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushNotification extends Notification
{
    use Queueable;

    public $message;
    public $id;

    public function __construct($message, $id)
    {
        $this->message = $message;
        $this->id = $id;
    }

    public function via($notifiable)
    {
        // Ensure the user has at least one valid subscription before sending
    if ($notifiable->pushSubscriptions->isEmpty()) {
        return [];
    }
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New Notification')
            ->body($this->message)
            ->icon('./images/logo2.png')
            ->data(['url' => env('APP_URL') . '/cook/order/' . $this->id])
            ->action('View App', 'notification_action');
    }
}

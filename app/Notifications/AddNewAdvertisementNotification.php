<?php

namespace App\Notifications;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddNewAdvertisementNotification extends Notification
{
    use Queueable;

    protected Advertisement $ad;
    /**
     * Create a new notification instance.
     */
    public function __construct($advertisement)
    {
        $this->ad = $advertisement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable)
    {
        //البيانات يلي هون رح تتخزن كلها بحقل 
        //data
        //الموجود في جدول الإشعارات

        return [
            "message" => ["en" => "A new ad has been added", "ar" => "تم إضافة إعلان جديد"],
            "ad_id" => $this->ad->id,
            "ad_owner" => $this->ad->user
        ];
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

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Advertisement;
use App\Models\Comment;

class AddNewCommentOnAdvertisementNotification extends Notification
{
    use Queueable;

    protected Advertisement $ad;
    protected Comment $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct($advertisement, $comment)
    {
        $this->ad = $advertisement;
        $this->comment = $comment;
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
            "message" => ["en" => "Add New Comment On You Ad", "ar" => "أضاف تعليق جديد على إعلانك"],
            "ad_id" => $this->ad->id,
            "comment_owner" => $this->comment->user
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

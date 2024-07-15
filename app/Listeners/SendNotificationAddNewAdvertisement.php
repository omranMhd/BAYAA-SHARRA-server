<?php

namespace App\Listeners;

use App\Events\AddNewAdvertisement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\AddNewAdvertisementNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class SendNotificationAddNewAdvertisement
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AddNewAdvertisement $event): void
    {
        $ad = $event->ad;

        // $user = User::find($ad->user_id);
        $users = User::where("type", "admin")->get();

        // $user->notify($ad->id);
        // $user->notify(new AddNewAdvertisementNotification($ad));
        //إرسال إشعارات لكل الآدمنز
        Notification::send(
            $users,
            new AddNewAdvertisementNotification($ad)
        );
    }
}

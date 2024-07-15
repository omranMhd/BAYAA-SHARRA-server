<?php

namespace App\Listeners;

use App\Events\RejectAdvertisement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\RejectAdvertisementNotification;


class SendNotificationRejectAdvertisement
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
    public function handle(RejectAdvertisement $event): void
    {
        $ad = $event->ad;

        $user = User::find($ad->user_id);
        // $user->notify($ad->id);
        $user->notify(new RejectAdvertisementNotification($ad));
    }
}

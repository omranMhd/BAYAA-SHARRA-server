<?php

namespace App\Listeners;

use App\Events\AddNewCommentAdvertisement;
use App\Models\Advertisement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\AddNewCommentOnAdvertisementNotification;


class SendNotificationAddNewCommentOnAdvertisement
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
    public function handle(AddNewCommentAdvertisement $event): void
    {
        $ad_id = $event->ad_id;
        $ad = Advertisement::find($ad_id);

        $user = User::find($ad->user_id);
        // $user->notify($ad->id);
        $user->notify(new AddNewCommentOnAdvertisementNotification($ad, $event->comment));
    }
}

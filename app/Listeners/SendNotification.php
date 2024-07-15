<?php

namespace App\Listeners;

use App\Events\ActivationAdvertisement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Notifications\AcceptancePublishingAdvertisementNotification;

class SendNotification
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
    public function handle(ActivationAdvertisement $event): void
    {

        $ad = $event->ad;

        $user = User::find($ad->user_id);
        // $user->notify($ad->id);
        $user->notify(new AcceptancePublishingAdvertisementNotification($ad));
    }
}

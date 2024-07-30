<?php

namespace App\Listeners;

use App\Events\AddNewComplaint;
use App\Models\Advertisement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddNewComplaintNotification;


class SendNotificationAddNewComplaint
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
    public function handle(AddNewComplaint $event): void
    {
        $complaint = $event->complaint;
        $ad = Advertisement::find($complaint->advertisement_id);
        // $complaint_owner = User::find($complaint->user_id);
        // $user = User::find($ad->user_id);
        $users = User::where("type", "admin")->get();

        // $user->notify($ad->id);
        // $user->notify(new AddNewAdvertisementNotification($ad));
        //إرسال إشعارات لكل الآدمنز
        Notification::send(
            $users,
            new AddNewComplaintNotification($ad, $complaint)
        );
    }
}

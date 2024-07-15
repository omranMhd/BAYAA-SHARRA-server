<?php

namespace App\Listeners;

use App\Events\ReplyOnComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Advertisement;
use App\Notifications\ReplyOnCommentNotification;

class SendNotificationReplyOnComment
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
    public function handle(ReplyOnComment $event): void
    {

        // dd($event);

        $ad_id = $event->ad_id;
        $ad = Advertisement::find($ad_id);

        // $user = User::find($event->);
        $user = $event->comment->user;
        // $user->notify($ad->id);
        $user->notify(new ReplyOnCommentNotification($ad, $event->reply));
    }
}

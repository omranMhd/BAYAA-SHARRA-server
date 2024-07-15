<?php

namespace App\Providers;

use App\Events\ActivationAdvertisement;
use App\Events\RejectAdvertisement;
use App\Events\AddNewAdvertisement;
use App\Events\AddNewCommentAdvertisement;
use App\Events\ReplyOnComment;
use App\Listeners\SendNotification;
use App\Listeners\SendNotificationRejectAdvertisement;
use App\Listeners\SendNotificationAddNewAdvertisement;
use App\Listeners\SendNotificationAddNewCommentOnAdvertisement;
use App\Listeners\SendNotificationReplyOnComment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ActivationAdvertisement::class => [
            SendNotification::class
        ],
        RejectAdvertisement::class => [
            SendNotificationRejectAdvertisement::class
        ],
        AddNewAdvertisement::class => [
            SendNotificationAddNewAdvertisement::class
        ],
        AddNewCommentAdvertisement::class => [
            SendNotificationAddNewCommentOnAdvertisement::class
        ],
        ReplyOnComment::class => [
            SendNotificationReplyOnComment::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

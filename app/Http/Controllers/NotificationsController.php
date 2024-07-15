<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function getAllUserNotification(Request $request)
    {
        $user = $request->user();
        return response()->json([
            "message" => "get all user notification done",
            "data" => $user->notifications,
            "unReadCount" => $user->unreadNotifications()->count()
        ]);
    }
    public function makeNotificationAsRead(Request $request, $notifi_id)
    {
        $user = $request->user();
        $notification = $user->unreadNotifications()->find($notifi_id);
        // $notification = $user->unreadNotifications;
        // return $notification;
        if ($notification) {
            $notification->markAsRead();
            return response()->json([
                "message" => "convert this notification done"
            ]);
        } else {
            return response()->json([
                "message" => "no notification with this id"
            ], 404);
        }
    }
}

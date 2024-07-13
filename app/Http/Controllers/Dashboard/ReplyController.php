<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function deleteReply($reply_id)
    {
        $reply = Reply::find($reply_id);

        if ($reply) {
            // return $comment->reply();
            $reply->delete();
            return response()->json([
                "message" => "delete reply done successfully !"
            ]);
        } else {
            return response()->json([
                "message" => "no reply with this id !"
            ], 404);
        }
    }
}

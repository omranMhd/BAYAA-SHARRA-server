<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Comment;

class CommentController extends Controller
{
    // get all comments and its replies for specific advertisement
    public function advertisementComments($ad_id)
    {
        if (!Advertisement::where('id', $ad_id)->exists()) {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 400);
        }

        $comments = Comment::with(["user" => function ($query) {
            $query->select("id", "firstName", "lastName", "image");
        }])->where("advertisement_id", $ad_id)->get();

        $comments->map(function ($comment) {
            $comment->load('reply');
            if ($comment->reply != null) {
                $comment->reply->load(['user' => function ($query) {
                    $query->select("id", "firstName", "lastName", "image");
                }]);
            }
            // $comment->reply()?->load('user');
        });

        return response()->json([
            "message" => "get all advertisement comments done successfully !",
            "data" => $comments
        ]);
    }

    public function deleteComment($comment_id)
    {
        $comment = Comment::find($comment_id);

        if ($comment) {

            $comment->reply()->delete();
            $comment->delete();
            return response()->json([
                "message" => "delete comment done successfully !"
            ]);
        } else {
            return response()->json([
                "message" => "no comment with this id !"
            ], 404);
        }

        // return $comment->reply();

    }
}

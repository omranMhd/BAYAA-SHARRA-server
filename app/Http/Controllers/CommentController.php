<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Comment;
use App\Models\User;
use App\Http\Requests\AddCommentRequest;
use Illuminate\Http\Request;
use App\Events\AddNewCommentAdvertisement;


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

    public function addComment(AddCommentRequest $request)
    {
        // return $request;


        if (!User::where('id', $request->user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "no user with this id"
            ], 400);
        }
        if (!Advertisement::where('id', $request->advertisement_id)->exists()) {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 400);
        }

        $comment = Comment::create([
            "user_id" => $request->user_id,
            "advertisement_id" => $request->advertisement_id,
            "value" => $request->value,
        ]);

        event(new AddNewCommentAdvertisement($request->advertisement_id, $comment));

        return response()->json([
            "message" => "adding comment done successfully"
        ], 201);
    }
    // just owner comment can delete it
    public function deleteComment($comment_id, $user_id)
    {
        if (!Comment::where('id', $comment_id)->where('user_id', $user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "you can not do this action because you are not the owner of comment"
            ], 403);
        } else {
            $comment = Comment::where('id', $comment_id)->where('user_id', $user_id)->first();

            // return $comment->reply();

            $comment->reply()->delete();
            $comment->delete();
            return response()->json([
                "message" => "delete comment done successfully !"
            ]);
        }
    }
}

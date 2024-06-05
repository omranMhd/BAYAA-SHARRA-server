<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\AddReplyRequest;
use App\Models\Advertisement;
use App\Models\Comment;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function addReply(AddReplyRequest $request)
    {

        //شوف هل عندك مستخدم بهذا الرقم 
        if (!User::where('id', $request->user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "no user with this id"
            ], 400);
        }
        // شوف هل عندك تعليق بهذا الرقم
        if (!Comment::where('id', $request->comment_id)->exists()) {
            return response()->json([
                "message" => "no comment with this id"
            ], 400);
        }

        // تحقق هل يوجد رد سابق على هذا التعليق 
        if (Reply::where("comment_id", $request->comment_id)->exists()) {
            return response()->json([
                "message" => "you can not reply more than one on same comment"
            ], 405);
        }



        // هون لازم نتاكد ونضمن انو المستخدم يلي عم يضيف الرد على هذا التعليق انو الو الحق بالاضافة
        // وذلك لازم يكون الاعلان يلي عليه هذا التعليق من ضمن اعلانات التابعة لهذا المستخدم حصرا

        $comment = Comment::find($request->comment_id);

        $ad_id = $comment->advertisement->id;

        $ads = Advertisement::select('id')->where('user_id', $request->user_id)->get();

        $ad_ids = array_map(function ($ad) {
            return $ad["id"];
        }, $ads->toArray());

        if (in_array($ad_id, $ad_ids)) {
            Reply::create([
                "user_id" => $request->user_id,
                "comment_id" => $request->comment_id,
                "value" => $request->value,
            ]);

            return response()->json([
                "message" => "adding reply done successfully !"
            ], 201);
        } else {
            return response()->json([
                "message" => "you can't adding reply on this comment !"
            ], 403);
        }
    }
    public function deleteReply($reply_id, $user_id)
    {
        if (!Reply::where('id', $reply_id)->where('user_id', $user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "you can not do this action because you are not the owner of reply"
            ], 403);
        } else {
            $reply = Reply::where('id', $reply_id)->where('user_id', $user_id)->first();

            // return $comment->reply();
            $reply->delete();
            return response()->json([
                "message" => "delete reply done successfully !"
            ]);
        }
    }
}

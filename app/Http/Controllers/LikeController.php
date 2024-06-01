<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function addLikeOnAdvertisement($user_id, $ad_id)
    {
        if (!User::where('id', $user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "no user with this id"
            ], 400);
        }
        if (!Advertisement::where('id', $ad_id)->exists()) {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 400);
        }


        if (Like::where('user_id', $user_id)
            ->where('advertisement_id', $ad_id)
            ->exists()
        ) {
            return response()->json([
                "message" => "advertisement already liked"
            ], 409);
        }

        $likeId = Like::create([
            'user_id' => $user_id,
            'advertisement_id' => $ad_id
        ])->id;

        return response()->json([
            "message" => "adding  like to advertisement done successfully"
        ], 201);
    }

    public function removeLikeFromAdvertisement($user_id, $ad_id)
    {
        if (!User::where('id', $user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "no user with this id"
            ], 400);
        }
        if (!Advertisement::where('id', $ad_id)->exists()) {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 400);
        }

        // remove like from advertisement if exist
        if (Like::where('user_id', $user_id)
            ->where('advertisement_id', $ad_id)
            ->exists()
        ) {
            $like = Like::where('user_id', $user_id)
                ->where('advertisement_id', $ad_id)
                ->first();

            $like->delete();

            return response()->json([
                "message" => "removing like from advertisement done successfully"
            ]);
        } else {
            return response()->json([
                "message" => "no liked ad to deletion"
            ], 404);
        }
    }

    public function checkIfAdvertisementIsLiked($user_id, $ad_id)
    {
        if (!User::where('id', $user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "no user with this id"
            ], 400);
        }
        if (!Advertisement::where('id', $ad_id)->exists()) {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 400);
        }

        if (Like::where('user_id', $user_id)
            ->where('advertisement_id', $ad_id)
            ->exists()
        ) {
            return response()->json([
                "message" => "like on advertisement exist",
                "isExist" => true
            ]);
        } else {
            return response()->json([
                "message" => "like on advertisement doesn't exist",
                "isExist" => false
            ]);
        }
    }
}

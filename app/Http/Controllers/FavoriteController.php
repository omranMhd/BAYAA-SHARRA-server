<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // هذا التابع يقوم باضافة اعلان ما الى القائمة المفضلة للمستخدم الحالي
    public function addAdvertisementToFavoriteList($user_id, $ad_id)
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


        if (Favorite::where('user_id', $user_id)
            ->where('advertisement_id', $ad_id)
            ->exists()
        ) {
            return response()->json([
                "message" => "advertisement already exist in favorite list"
            ], 409);
        }

        $favId = Favorite::create([
            'user_id' => $user_id,
            'advertisement_id' => $ad_id
        ])->id;

        return response()->json([
            "message" => "adding advertisement to favorite list done successfully"
        ], 201);
    }
    public function removeAdvertisementFromFavoriteList($user_id, $ad_id)
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

        // remove this ad from favorite list if exist
        if (Favorite::where('user_id', $user_id)
            ->where('advertisement_id', $ad_id)
            ->exists()
        ) {
            $fav = Favorite::where('user_id', $user_id)
                ->where('advertisement_id', $ad_id)
                ->first();

            $fav->delete();

            return response()->json([
                "message" => "removing advertisement from favorite list done successfully"
            ]);
        } else {
            return response()->json([
                "message" => "no favorite ad to deletion"
            ], 404);
        }
    }
    public function checkIfAdvertisementInFavoriteList($user_id, $ad_id)
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

        if (Favorite::where('user_id', $user_id)
            ->where('advertisement_id', $ad_id)
            ->exists()
        ) {
            return response()->json([
                "message" => "advertisement exist in favorite list",
                "isExist" => true
            ]);
        } else {
            return response()->json([
                "message" => "advertisement doesn't exist in favorite list",
                "isExist" => false
            ]);
        }
    }
}

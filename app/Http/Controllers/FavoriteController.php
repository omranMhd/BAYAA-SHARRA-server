<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ConvertAdvertForm;
use App\Models\Category;

class FavoriteController extends Controller
{
    use ConvertAdvertForm;
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
    public function allFavoriteList(Request $request, $user_id)
    {

        // return  $request->query("mainCategory");
        $category_ids = [];
        if ($request->has("mainCategory")) {
            if (Category::where("name_en", $request->query("mainCategory"))->exists()) {

                $category = Category::where("name_en", $request->query("mainCategory"))->first();
                // return $category->childCategories->count();
                // شوف اذا هي الفئة لها ابناء او لا
                //اذا لها ابناء
                if ($category->childCategories->count() > 0) {
                    // جيب ارقام الفئات الأبناء
                    $category_ids = $category->childCategories->map(function ($c) {
                        return $c->id;
                    })->toArray();
                } else if ($category->childCategories->count() == 0) {
                    array_push($category_ids, $category->id);
                }
                // return $category_ids;
                // $category_id = $category->id;

            } else {
                return response()->json([
                    "message" => "no category found with this name !"
                ], 404);
            }
        }

        $favorites =  Favorite::with(["advertisement" => function ($query) {
            $query->select('id', 'created_at', 'address', 'title', 'category_id');
        }])->where('user_id', $user_id)->get();

        $ads = $favorites->map(function ($fav) {
            return $fav->advertisement;
        });

        if (count($category_ids) != 0) {

            $ads = $ads->filter(function ($ad) use ($category_ids) {

                return in_array($ad->category_id, $category_ids);
            })->values();
        }

        // return $ads;



        $ads = $this->convertToCardForm($ads, $user_id);
        return response()->json([
            "message" => "get favorites list done successfully",
            "data" => $ads
        ]);
    }
}

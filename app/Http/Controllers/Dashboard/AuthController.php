<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\UpdateAdminInfoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\CountriesInfo;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    use CountriesInfo;
    public function login(LoginAdminRequest $request)
    {

        // ($request->has('email')) ? $authKey = 'email' : $authKey = 'phone';

        $authKey = 'email';

        $credentials = $request->only($authKey, 'password');
        $credentials["type"] = "admin";

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // return $authKey;
        $user = User::where($authKey, $request->$authKey)->first();

        return response()->json([
            'massage' => "login is done",
            'data' => [
                'user' => $user,
                'token' => $user->createToken('api token of ' . $user->firstName)->plainTextToken
            ]
        ]);
    }
    // register just new admins accounts
    public function register(RegisterUserRequest $request)
    {

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'type' => 'admin'
        ]);

        $user->email_verified_at = now()->timestamp;
        $user->save();

        return response()->json([
            "massage" => "registration is done , verify your account",
        ], 201);
    }
    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'logout is done']);
    }
    public function users()
    {
        $users =  User::select("id", "firstName", "lastName", "email", "address", "image", "type", "account_status")->orderBy("type", "desc")->get();

        $newArrayUsers = $users;


        $newArrayUsers = $newArrayUsers->map(function ($user) {
            $user["address"]  = $this->getTranslatedCountryAndCityName(json_decode($user["address"])->country, json_decode($user["address"])->city);

            return $user;
        });

        return response()->json([
            "message" => "get all users done",
            "data" => $newArrayUsers
        ]);
        // return response()->json([
        //     "message" => "get all users done",
        //     "data" => $users
        // ]);
    }
    public function deleteUser($user_id)
    {
        $user = User::find($user_id);
        // $user->delete();



        if ($user) {
            // $ad->delete();

            //حذف كل اعلانات المستخدم
            $user_ads = $user->advertisements;
            foreach ($user_ads as $ad) {
                //حذف الشكاوي المتعلقة بهذا الأعلان
                $ad->complaints->map(function ($c) {
                    $c->delete();
                });

                //حذف الاعلان هذا من القوائم المفضلة
                $ad->favorites->map(function ($c) {
                    $c->delete();
                });

                //حذف الاعجابات المتعلقة بهذا الاعلان
                // return $ad->likes;
                $ad->likes->map(function ($c) {
                    $c->delete();
                });

                //حذف التعليقات والردود المتعلقة بها ان وجدت
                // return $ad->comments->load('reply');
                $ad->comments->load('reply')->map(function ($c) {
                    if ($c->reply != null) {
                        $c->reply->delete();
                    }
                    $c->delete();
                });

                //حذف مسارات الصور وملفاتها
                // return $ad->images;
                $ad->images->map(function ($c) {
                    //احذف ملف الصورة
                    Storage::disk('public')->delete($c->url);

                    //بعدين احذف مسارها من الجدول
                    $c->delete();
                });

                //حذف البيانات الاضافية من جداول الفلاتر

                $ad->apartementFilter?->delete();
                $ad->farmFilter?->delete();
                $ad->landFilter?->delete();
                $ad->commercialStoreFilter?->delete();
                $ad->officeFilter?->delete();
                $ad->shalehFilter?->delete();
                $ad->vellaFilter?->delete();
                $ad->commonVehicleFilter?->delete();
                $ad->sparePartsVehicleFilter?->delete();
                $ad->mobTabFilter?->delete();
                $ad->computerFilter?->delete();
                $ad->execoarFilter?->delete();
                $ad->restDevicesFilter?->delete();
                $ad->furnitureFilter?->delete();
                $ad->clothesFasionFilter?->delete();
                $ad->generalAdditionalField?->delete();


                //حذف الاعلان نفسو
                $ad->delete();
            }

            //حذف كل الشكاوي التي قدمها المستخدم
            $user_complaints = $user->complaints;
            $user_complaints->map(function ($c) {
                $c->delete();
            });

            //حذف كل الاعجابات التي قدمها المستخدم
            $user_likes = $user->likes;
            $user_likes->map(function ($c) {
                $c->delete();
            });

            //حذف التعليقات والردود المتعلقة بها ان وجدت
            $user_comments = $user->comments->load('reply');
            $user_comments->map(function ($c) {
                if ($c->reply != null) {
                    $c->reply->delete();
                }
                $c->delete();
            });

            //حذف كل الزيارات التي قام بها المستخدم
            $user_visitors = $user->visitors;
            $user_visitors->map(function ($c) {
                $c->delete();
            });

            //حذف كل القائمة المفضلة التي قام بها المستخدم
            $user_favorites = $user->favorites;
            $user_favorites->map(function ($c) {
                $c->delete();
            });


            //حذف بيانات المستخدم
            $user->delete();

            if ($user->image != null) {

                Storage::disk('public')->delete($user->image);
            }



            return response()->json([
                "message" => "delete done"
            ]);
        } else {

            return response()->json([
                "message" => "No user with this id"
            ], 404);
        }
    }
    public function editAccountStatus(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            if ($request->has("account_status")) {
                $user->account_status = $request->account_status;
                $user->save();
                return response()->json([
                    "message" => "change account status to " . $request->account_status . " done"
                ]);
            }
        } else {
            return response()->json([
                "message" => "No user with this id"
            ], 404);
        }
    }
    public function updateAdminInfo(UpdateAdminInfoRequest $request, $admin_id)
    {
        $admin = User::where("id", $admin_id)->where("type", "admin")->first();

        if ($admin) {
            $admin->password = Hash::make($request->password);
            if ($request->has("firstName")) {
                $admin->firstName = $request->firstName;
            }
            if ($request->has("lastName")) {
                $admin->lastName = $request->lastName;
            }
            if ($request->has("address")) {
                $admin->address = $request->address;
            }
            if ($request->has("email")) {
                $admin->email = $request->email;
            }

            $admin->save();

            return response()->json([
                "message" => "update admin info done"
            ]);
        } else {
            return response()->json([
                "message" => "no admin with this id"
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\VerifyAccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Models\ActivationCode;
use Nette\Utils\Random;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address
        ]);

        $activation_code = Random::generate(6, "0-9");
        $verified_by = $request->has('email') ? 'email' : 'phone';
        ActivationCode::create([
            'user_id' => $user->id,
            'code' => $activation_code,
            'is_used' => false,
            'verified_by' => $verified_by,
        ]);

        Mail::to($request->email)->send(new EmailVerification($activation_code));

        return response()->json([
            'status' => "registration is done , verify your account",
            'massage' => "",
            'data' => [
                'user' => $user,
                'token' => $user->createToken('api token of ' . $user->firstName)->plainTextToken
            ]

        ]);
    }

    public function login(LoginUserRequest $request)
    {

        ($request->has('email')) ? $authKey = 'email' : $authKey = 'phone';

        $credentials = $request->only($authKey, 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // return $authKey;
        $user = User::where($authKey, $request->$authKey)->first();

        return response()->json([
            'status' => "login is done",
            'massage' => "",
            'data' => [
                'user' => $user,
                'token' => $user->createToken('api token of ' . $user->firstName)->plainTextToken
            ]
        ]);
    }
    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'logout is done']);
    }
    public function verifyAccount(VerifyAccountRequest $request)
    {
        $activationCode = ActivationCode::where('code', $request->code)
            ->where('user_id', $request->user_id)
            ->where('is_used', false)->first();

        if ($activationCode) {
            try {
                DB::beginTransaction();

                $activationCode->is_used = true;
                $activationCode->save();

                $user = User::find($request->user_id);

                if ($activationCode->verified_by == 'email') {
                    $user->email_verified_at = now()->timestamp;
                    $user->save();
                } else {
                    $user->phone_verified_at = now()->timestamp;
                    $user->save();
                }

                DB::commit();
                return response()->json(['message' => 'verification done']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'verification failed'], 402);
            }
        } else {
            return response()->json(['message' => 'invalid verification code'], 400);
        }
    }
}
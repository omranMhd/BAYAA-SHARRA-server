<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\VerifyAccountRequest;
use App\Http\Requests\ResendCodeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Models\ActivationCode;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\VerificationCode;

class AuthController extends Controller
{
    use VerificationCode;

    public function register(RegisterUserRequest $request)
    {

        $activation_code = $this->generateCode();
        $verified_by = $request->has('email') ? 'email' : 'phone';
        $user_id = null;


        if ($verified_by == 'email') {
            $user_id = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address
            ])->id;

            ActivationCode::create([
                'user_id' => $user_id,
                'code' => $activation_code,
                'is_used' => false,
                'verified_by' => $verified_by,
            ]);

            // send activation code by email
            Mail::to($request->email)->send(new EmailVerification($activation_code));
        } else if ($verified_by == 'phone') {
            $user_id = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'address' => $request->address
            ])->id;

            ActivationCode::create([
                'user_id' => $user_id,
                'code' => $activation_code,
                'is_used' => false,
                'verified_by' => $verified_by,
            ]);

            // send activation code by SMS

        }

        $user = User::find($user_id);

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

        // if the account is unverified
        if ($user->email_verified_at == null && $user->phone_verified_at == null) {

            return response()->json([
                'message' => 'Your account is unverified',
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken('api token of ' . $user->firstName)->plainTextToken
                ]
            ], 423);
        }
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

                //update activation Code to make it used and invalid to use anymore 
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
                return response()->json(['message' => 'verification done', 'data' => $user]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'verification failed'], 402);
            }
        } else {
            return response()->json(['message' => 'invalid verification code'], 400);
        }
    }
    public function resendCode(ResendCodeRequest $request)
    {
        $activation_code = $this->generateCode();

        $activation_code_id = ActivationCode::create([
            'user_id' => $request->user_id,
            'code' => $activation_code,
            'is_used' => false,
            'verified_by' => $request->verified_by,
        ])->id;

        if ($request->verified_by == "email") {
            try {
                // send activation code by email
                Mail::to($request->email)->send(new EmailVerification($activation_code));

                return response()->json([
                    "message" => "Check your e-mail. The code has been sent to him."
                ]);
            } catch (\Exception $e) {
                // Retrieve the activation_code by ID
                $activation_code = ActivationCode::find($activation_code_id);

                // Delete the activation_code
                if ($activation_code) {
                    $activation_code->delete();
                }
                return response()->json([
                    "message" => "Failed to send an email"
                ], 500);
            }
        } else if ($request->verified_by == "phone") {
            // send activation code by SMS
        }
    }
}

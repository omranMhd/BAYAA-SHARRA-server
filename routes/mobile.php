<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user3', function (Request $request) {
    return $request->user();
});

//public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/all-users', function () {
        return User::get();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verify-account', [AuthController::class, 'verifyAccount']);
    Route::post('/resend-code', [AuthController::class, 'resendCode']);
});

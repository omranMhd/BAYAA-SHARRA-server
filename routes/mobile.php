<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountriesInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ComplaintController;
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
Route::get('/countries-info', [CountriesInfoController::class, 'getInfo']);
Route::get('/main-categories', [CategoryController::class, 'mainCategories']);
Route::get('/sub-categories/{id}', [CategoryController::class, 'subCategories']);
// get all active advertisements to users 
Route::get('/all-advertisements', [AdvertisementController::class, 'getAllAdvertisement']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/all-users', function () {
        return User::get();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verify-account', [AuthController::class, 'verifyAccount']);
    Route::post('/resend-code', [AuthController::class, 'resendCode']);
    Route::post('/add-new-ad', [AdvertisementController::class, 'addNewAdvertisement']);
    Route::get('/ad-details/{id}', [AdvertisementController::class, 'advertisementDetails']);
    Route::post('/add-ad-favorite/{user_id}/{ad_id}', [FavoriteController::class, 'addAdvertisementToFavoriteList']);
    Route::delete('/remove-ad-favorite/{user_id}/{ad_id}', [FavoriteController::class, 'removeAdvertisementFromFavoriteList']);
    Route::get('/is-ad-in-favorite-list/{user_id}/{ad_id}', [FavoriteController::class, 'checkIfAdvertisementInFavoriteList']);
    Route::post('/add-like/{user_id}/{ad_id}', [LikeController::class, 'addLikeOnAdvertisement']);
    Route::delete('/remove-like/{user_id}/{ad_id}', [LikeController::class, 'removeLikeFromAdvertisement']);
    Route::get('/is-ad-liked/{user_id}/{ad_id}', [LikeController::class, 'checkIfAdvertisementIsLiked']);
    Route::post('/add-complaint', [ComplaintController::class, 'addComplaint']);
});

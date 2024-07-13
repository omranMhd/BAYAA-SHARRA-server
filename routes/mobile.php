<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountriesInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VehiclesInfoController;
use App\Http\Controllers\SliderImagesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/countries-info', [CountriesInfoController::class, 'getInfo']);
Route::get('/main-categories', [CategoryController::class, 'mainCategories']);
Route::get('/sub-categories/{id}', [CategoryController::class, 'subCategories']);
// get all active advertisements to users 
Route::get('/all-advertisements/{user_id?}', [AdvertisementController::class, 'getAllAdvertisement']);
Route::get('/advertisements-filter/{user_id?}', [AdvertisementController::class, 'advertisementsFilter']);
Route::get('/advertisements-search/{user_id?}', [AdvertisementController::class, 'advertisementsSearch']);
Route::get('/vehicles-brands', [VehiclesInfoController::class, 'getVehicleBrands']);
Route::get('/ad-details/{id}', [AdvertisementController::class, 'advertisementDetails']);
Route::get('/similar-ads/{ad_id}/{user_id?}', [AdvertisementController::class, 'similarAds']);
Route::get('/advertisement-comments/{ad_id}', [CommentController::class, 'advertisementComments']);
Route::get('/silder-images', [SliderImagesController::class, 'getAllImages']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verify-account', [AuthController::class, 'verifyAccount']);
    Route::post('/resend-code', [AuthController::class, 'resendCode']);
    Route::post('/add-new-ad', [AdvertisementController::class, 'addNewAdvertisement'])->middleware('checkUserAccountStatus');
    Route::post('/add-ad-favorite/{user_id}/{ad_id}', [FavoriteController::class, 'addAdvertisementToFavoriteList']);
    Route::delete('/remove-ad-favorite/{user_id}/{ad_id}', [FavoriteController::class, 'removeAdvertisementFromFavoriteList']);
    Route::get('/is-ad-in-favorite-list/{user_id}/{ad_id}', [FavoriteController::class, 'checkIfAdvertisementInFavoriteList']);
    Route::post('/add-like/{user_id}/{ad_id}', [LikeController::class, 'addLikeOnAdvertisement']);
    Route::delete('/remove-like/{user_id}/{ad_id}', [LikeController::class, 'removeLikeFromAdvertisement']);
    Route::get('/is-ad-liked/{user_id}/{ad_id}', [LikeController::class, 'checkIfAdvertisementIsLiked']);
    Route::post('/add-complaint', [ComplaintController::class, 'addComplaint']);
    Route::post('/add-comment', [CommentController::class, 'addComment']);
    Route::delete('/delete-comment/{comment_id}/{user_id}', [CommentController::class, 'deleteComment']);
    Route::post('/add-reply', [ReplyController::class, 'addReply']);
    Route::delete('/delete-reply/{reply_id}/{user_id}', [ReplyController::class, 'deleteReply']);
    Route::get('/favorite-ads/{user_id}', [FavoriteController::class, 'allFavoriteList']);
    Route::get('/user-info/{user_id}', [AuthController::class, 'getUserInfo']);
    Route::post('/update-user-info/{user_id}', [AuthController::class, 'updateUserInfo']);
    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
    Route::get('/user-advertisements/{user_id}', [AdvertisementController::class, 'getAllUserAdvertisements']);
    Route::delete('/delete-advertisement/{id}', [AdvertisementController::class, 'deleteAdvertisement']);
    Route::post('/update-advertisement/{id}', [AdvertisementController::class, 'updateAdvertisement']);
});

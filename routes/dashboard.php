<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\StatisticsController;
use App\Http\Controllers\Dashboard\AdvertisementController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\ReplyController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CountriesInfoController;
use App\Http\Controllers\Dashboard\ComplaintController;
use App\Http\Controllers\Dashboard\VehiclesInfoController;
use App\Http\Controllers\Dashboard\SliderImagesController;
use App\Http\Controllers\NotificationsController;

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

Route::middleware('auth:sanctum')->get('/user2', function (Request $request) {
    return $request->user();
});

//public routes
Route::post('/login', [AuthController::class, 'login']);

Route::get('/countries-info', [CountriesInfoController::class, 'getInfo']);
Route::get('/main-categories', [CategoryController::class, 'mainCategories']);
Route::get('/sub-categories/{id}', [CategoryController::class, 'subCategories']);
Route::get('/vehicles-brands', [VehiclesInfoController::class, 'getVehicleBrands']);


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/get-statistics', [StatisticsController::class, 'getSomeStatistics']);
    Route::get('/users', [AuthController::class, 'users']);
    Route::delete('/delete-user/{user_id}', [AuthController::class, 'deleteUser']);
    Route::post('/edit-account-status/{user_id}', [AuthController::class, 'editAccountStatus']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/update-admin-info/{admin_id}', [AuthController::class, 'updateAdminInfo']);
    Route::get('/all-advertisements', [AdvertisementController::class, 'gatAllAdvertisement']);
    Route::get('/advertisements-filter', [AdvertisementController::class, 'advertisementsFilter']);
    Route::get('/advertisements-search', [AdvertisementController::class, 'advertisementsSearch']);
    Route::delete('/delete-advertisement/{id}', [AdvertisementController::class, 'deleteAdvertisement']);
    Route::get('/ad-details/{id}', [AdvertisementController::class, 'advertisementDetails']);
    Route::get('/advertisement-comments/{ad_id}', [CommentController::class, 'advertisementComments']);
    Route::delete('/delete-comment/{comment_id}', [CommentController::class, 'deleteComment']);
    Route::delete('/delete-reply/{reply_id}', [ReplyController::class, 'deleteReply']);
    Route::post('/update-advertisement/{id}', [AdvertisementController::class, 'updateAdvertisement']);

    Route::get('/all-complaints', [ComplaintController::class, 'allComplaints']);
    Route::delete('/delete-complaint/{complaint_id}', [ComplaintController::class, 'deleteComplaint']);

    Route::get('/silder-images', [SliderImagesController::class, 'getAllImages']);
    Route::post('/save-image', [SliderImagesController::class, 'saveImage']);
    Route::delete('/delete-image/{image_id}', [SliderImagesController::class, 'deleteImage']);

    Route::get('/all-notifications', [NotificationsController::class, 'getAllUserNotification']);
    Route::post('/make-notification-read/{notifi_id}', [NotificationsController::class, 'makeNotificationAsRead']);
});

<?php
use App\Http\Controllers\Api\AdsMobileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FavoriteVideoController;
use App\Http\Controllers\Api\NewsCommentController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\VideoNewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix("v1")->group(function () {
    /*
    Image Upload
     */
    Route::post('/image-upload', [AuthController::class, "fileUploader"]);
    /*
    Authentication Routes
    register, login, forget-password, verify, resend-code,user profile update,change password,get user,
     */
    Route::prefix('auth/user')->group(function () {
        Route::post('/register', [AuthController::class, "register"]);
        Route::post('/login', [AuthController::class, "login"]);
        Route::post('/forgot-password', [AuthController::class, "forgotPassword"]);
        Route::post('/user-verify', [AuthController::class, "UserVerify"]);
        Route::patch('/resend-code', [AuthController::class, "resendCode"]);
        Route::post('/change-password', [AuthController::class, "changePassword"]);
        //user
        Route::middleware('auth:sanctum')->group(function(){
            Route::get('/profile', [AuthController::class, "profile"]);
            Route::patch('/profile/update', [AuthController::class, "updateProfile"]);
            Route::patch('/update-password', [AuthController::class, "profileChangePassword"]);
        });

    });

    //notification
    Route::post('send-notification', [NotificationController::class, "sendNotification"]);
    //advertisements
    Route::get('advertisement/mobile', [AdsMobileController::class, "index"]);
    //notification
    Route::get('notification', [NotificationController::class, "index"]);
    //About us
    Route::get('about/about-us', [AdsMobileController::class, "about"]);
    //category
    Route::get('category/get-all', [CategoryController::class, "index"]);

    //news
    Route::get('news/get-all/', [NewsController::class, "index"]);
    Route::get('news/get-all-feature-news', [NewsController::class, "allFeatureNews"]);
    Route::get('news/get-feature-news', [NewsController::class, "FeatureNews"]);
    Route::get('news/show/', [NewsController::class, "view"]);
    Route::get('news/get-by-category', [NewsController::class, "getByCategory"]);
    Route::post('/news/search', [NewsController::class, "newsSearch"]);
    //Video news
    Route::get('video/get-all', [VideoNewsController::class, "index"]);
    Route::get('video/show/', [VideoNewsController::class, "view"]);
    Route::post('video/search', [VideoNewsController::class, "videoNewsSearch"]);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // user
        Route::post('auth/logout', [AuthController::class, "logout"]);
        //videos
        Route::get('favorite-video', [VideoController::class, "favoriteVideo"]);
        Route::get('history-video', [VideoController::class, "historyVideo"]);
        //report
        Route::post('reports/video/add', [ReportController::class, "store"]);
        Route::post('reports/news/add', [ReportController::class, "newsReportStore"]);
        //video news comment
        Route::post('comment/video/add', [CommentController::class, "store"]);
        Route::get('comment/video/get-all/', [CommentController::class, "view"]);
        //news comment
        Route::post('comment/news/add', [NewsCommentController::class, "store"]);
        Route::get('comment/news/get-all/', [NewsCommentController::class, "view"]);
        //Favorite
        Route::post('favorite/video/added', [FavoriteVideoController::class, "store"]);
        Route::post('favorite/news/added', [FavoriteVideoController::class, "newsStore"]);
        Route::get('favorite/video/list', [FavoriteVideoController::class, "favoriteList"]);
        Route::get('favorite/news/list', [FavoriteVideoController::class, "favoriteNewsList"]);
        Route::post('favorite/news/delete/', [FavoriteVideoController::class, "favoriteNewsDelete"]);
        Route::post('favorite/video/delete', [FavoriteVideoController::class, "favoriteVideoDelete"]);
    });
});
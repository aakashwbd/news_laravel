<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstallerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MgtStatusController;
use App\Http\Controllers\NewsCommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SmtpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoNewsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix("installation")->group(function () {
    Route::view('/', 'installation.installer');
    Route::post('/env-update', [\App\Http\Controllers\InstallerController::class, "envUpdate"]);
    Route::post('/db-check', [\App\Http\Controllers\InstallerController::class, "dbCheck"]);
    Route::post('/finished', [\App\Http\Controllers\InstallerController::class, "finished"]);
    Route::post('/license-checker', [\App\Http\Controllers\InstallerController::class, "licenseChecker"]);
});

Route::group(['middleware' => 'installationCheck'], function () {
    Auth::routes();
    Route::get('forgotpassword', [AuthController::class, "recoveryPassword"]);
     Route::redirect('/', '/admin/dashboard', 301);
    Route::group(['middleware' => 'auth'], function () {
        Route::prefix('admin')->group(function () {
            Route::get('profile', [AdminController::class, "show"]);
            Route::post('profile/{id}/update', [AdminController::class, "profileUpdate"]);
            Route::group(['middleware' => 'accessControl'], function () {
                Route::get('/dashboard', [DashboardController::class, "index"]);
                // Category
                Route::get('category', [CategoryController::class, "categoryIndex"]);
                Route::post('category/category-create', [CategoryController::class, "categoryCreate"]);
                Route::post('category/category-store', [CategoryController::class, "categoryStore"]);
                Route::post('category/edit', [CategoryController::class, "categoryEdit"]);
                Route::post('category/update', [CategoryController::class, "categoryUpdate"]);
                Route::post('category/filter', [CategoryController::class, "categoryFilter"]);
                Route::delete('category/{id}/{model}', [CategoryController::class, "destroy"]);
                Route::post('category/manage-category', [CategoryController::class, "categoryApproval"]);
                Route::post('category/file-upload', [CategoryController::class, "fileUploader"]);
                // news
                Route::get('news', [NewsController::class, "newsIndex"]);
                Route::get('news/create', [NewsController::class, "newsCreate"]);
                Route::post('news/store', [NewsController::class, "newsStore"]);
                Route::get('news/edit/{id}', [NewsController::class, "newsEdit"]);
                Route::post('news/update', [NewsController::class, "newsUpdate"]);
                Route::post('news/filter', [NewsController::class, "newsFilter"]);
                Route::delete('news/{id}', [NewsController::class, "destroy"]);
                Route::post('news/file-upload', [NewsController::class, "fileUploader"]);

                //news approval
                Route::get('news-approval', [NewsController::class, "newsApproval"]);
                Route::post('news/manage-newsApproval', [NewsController::class, "manageApproval"]);
                /// video news
                Route::get('video', [VideoNewsController::class, "VedioNewsIndex"]);
                Route::get('video/news/create', [VideoNewsController::class, "VedioNewsCreate"]);
                Route::post('video/news/store', [VideoNewsController::class, "videoNewsStore"]);
                Route::get('video/news/edit/{id}', [VideoNewsController::class, "videoNewsEdit"]);
                Route::post('video/news/update', [VideoNewsController::class, "newsUpdate"]);
                Route::post('video/news/filter', [VideoNewsController::class, "videoFilter"]);
                Route::delete('video/news/{id}', [VideoNewsController::class, "destroy"]);
                Route::post('video/manage-videoApproval', [VideoNewsController::class, "managevideoApproval"]);
                Route::post('video/file-upload', [VideoNewsController::class, "fileUploader"]);

                //management status
                Route::post('management-status', [MgtStatusController::class, "status"]);
                //user management
                Route::get('user', [UserController::class, "index"]);
                Route::get('user/create', [UserController::class, "create"]);
                Route::post('user/store', [UserController::class, "store"]);
                Route::post('user/filter', [UserController::class, "filter"]);
                Route::get('user/{id}/edit', [UserController::class, "edit"]);
                Route::post('user/{id}/update', [UserController::class, "update"]);
                Route::delete('user/{id}', [UserController::class, "destroy"]);
                //video comment
                Route::get('comment', [CommentController::class, "index"]);
                Route::post('comment/status', [CommentController::class, "status"]);
                Route::post('comment/filter', [CommentController::class, "filter"]);
                Route::delete('comment/{id}', [CommentController::class, "destroy"]);
                //News comment
                Route::get('comment/news', [NewsCommentController::class, "index"]);
                Route::post('comment/news/status', [NewsCommentController::class, "status"]);
                Route::post('comment/news/filter', [NewsCommentController::class, "filter"]);
                Route::delete('comment/news/{id}', [NewsCommentController::class, "destroy"]);
                //report
                Route::get('report', [ReportController::class, "index"]);
                Route::post('report/status', [ReportController::class, "status"]);
                Route::post('report/filter', [ReportController::class, "filter"]);
                Route::post('report/report-show', [ReportController::class, "reportShow"]);
                Route::delete('report/{id}', [ReportController::class, "destroy"]);
                //news report
                Route::get('report/news', [NewsReportController::class, "index"]);
                Route::post('report/news/status', [NewsReportController::class, "status"]);
                Route::post('report/news/filter', [NewsReportController::class, "filter"]);
                Route::post('report/news/report-show', [NewsReportController::class, "reportShow"]);
                Route::delete('report/news/{id}', [NewsReportController::class, "destroy"]);

                //admin management
                Route::get('admin', [AdminController::class, "adminIndex"]);
                Route::get('admin/super-admin', [AdminController::class, "superAdminIndex"]);
                Route::get('admin/create', [AdminController::class, "create"]);
                Route::post('admin/store', [AdminController::class, "store"]);
                Route::post('admin/filter', [AdminController::class, "filter"]);
                Route::post('admin/super-admin/filter', [AdminController::class, "superAdminFilter"]);
                Route::get('admin/{id}/edit', [AdminController::class, "edit"]);
                Route::post('admin/{id}/update', [AdminController::class, "update"]);
                Route::delete('admin/{id}', [AdminController::class, "destroy"]);

                Route::view('admin-management', 'admin.index');
                Route::view('admin-management/create', 'admin.create');
                Route::view('admin-management/create', 'admin.create');

                //basic-settings
                Route::get('basic-settings', [SettingsController::class, "basicSettings"]);
                Route::post('basic-settings/update', [SettingsController::class, "basicSettingsUpdate"]);
                Route::post('basic-settings/create', [SettingsController::class, "basicSettingsCreate"]);
                Route::post('basic-settings/change-password', [UserController::class, "changePassword"]);
                Route::post('basic-settings/update-password', [UserController::class, "updatePassword"]);

                //advertisement
                Route::get('advertisement', [AdController::class, "mobileAd"]);
                Route::post('advertisement/mobileAdUpdate', [AdController::class, "mobileAdUpdate"]);
                Route::view('advertisement/web', 'advertisement.web');

                //notification
                Route::get('notification', [NotificationController::class, "index"]);
                Route::post('notification/create', [NotificationController::class, "create"]);
                Route::post('notification/store', [NotificationController::class, "store"]);
                Route::post('notification/filter', [NotificationController::class, "filter"]);
                Route::delete('notification/{id}', [NotificationController::class, "destroy"]);
                Route::get('notification/manage-notification', [NotificationController::class, "manageNotification"]);
                Route::post('notification/manage-notification-update', [NotificationController::class, "manageNotificationUpdate"]);
                Route::post('notification/manage-notification/get-mobile-data', [NotificationController::class, "getMobileData"]);
                Route::post('notification/manage-notification/get-web-data', [NotificationController::class, "getWebData"]);
                //SMTP
                Route::get('smtp', [SmtpController::class, "index"]);
                Route::get('smtp/create', [SmtpController::class, "create"]);
                Route::post('smtp/store', [SmtpController::class, "store"]);
                Route::post('smtp/update', [SmtpController::class, "update"]);

            });

            Route::get('php-info', function () {
                echo phpInfo();
            });
        });
    });
});


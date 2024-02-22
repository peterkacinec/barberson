<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResendEmailVerificationController;
use App\Http\Controllers\Api\Auth\ResetForgottenPasswordController;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\V1\CategoryListController;
use App\Http\Controllers\Api\V1\CommentListController;
use App\Http\Controllers\Api\V1\CustomerProfileController;
use App\Http\Controllers\Api\V1\EditCustomerProfileController;
use App\Http\Controllers\Api\V1\SaveCommentController;
use App\Http\Controllers\Api\V1\CustomerListController;
use App\Http\Controllers\Api\V1\OrderDetailController;
use App\Http\Controllers\Api\V1\OrderListController;
use App\Http\Controllers\Api\V1\SaveOrderController;
use App\Http\Controllers\Api\V1\ProviderDetailController;
use App\Http\Controllers\Api\V1\ProviderListController;
use App\Http\Controllers\Api\V1\ServiceListController;
use App\Http\Controllers\Api\V1\SaveServiceController;
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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    Route::group(['middleware' => 'auth:sanctum, verified'], function() {
        Route::post('/comments', SaveCommentController::class)->name('comment.save');
        Route::get('/orders', OrderListController::class)->name('order.list');
        Route::get('/orders/{order}', OrderDetailController::class)->name('order.detail');
        Route::post('/orders', SaveOrderController::class)->name('order.save');
        Route::post('/services', SaveServiceController::class)->name('service.save');
        Route::get('/customers/profile', CustomerProfileController::class)->name('customer.profile');
        Route::put('/customers/profile', EditCustomerProfileController::class)->name('customer.profile.edit');
    });

    Route::get('/categories', CategoryListController::class)->name('category.list');
    Route::get('/customers', CustomerListController::class)->name('customer.list');
    Route::get('/providers', ProviderListController::class)->name('provider.list');
    Route::get('/providers/{provider}', ProviderDetailController::class)->name('provider.detail');
    Route::get('/providers/{provider}/comments', CommentListController::class)->name('comment.list');
    Route::get('/providers/{provider}/services', ServiceListController::class)->name('service.list');
});

Route::get('/auth/logout', LogoutController::class)->name('user.logout')->middleware('auth:sanctum');
Route::post('/auth/register', RegistrationController::class)->name('user.register');
Route::post('/auth/login', LoginController::class)->name('user.login');
Route::post('/auth/forgot-password', ForgotPasswordController::class)->name('user.forgot.password');
Route::post('/auth/reset-password', ResetForgottenPasswordController::class)->name('user.reset.forgotten.password');
Route::put('/auth/update-password', UpdatePasswordController::class)->name('user.update.password')->middleware('auth:sanctum, verified');
Route::post('/auth/email/verify/{id}/{hash}', EmailVerificationController::class)->name('verification.verify')->middleware('auth:sanctum');
Route::post('/auth/email/resend-verification-notification', ResendEmailVerificationController::class)->name('verification.resend')->middleware('auth:sanctum');

//todo odtestovat middleware throttle:6,1 a verified

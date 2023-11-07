<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CommentListController;
use App\Http\Controllers\Api\V1\SaveCommentController;
use App\Http\Controllers\Api\V1\CustomerListController;
use App\Http\Controllers\Api\V1\SaveCustomerController;
use App\Http\Controllers\Api\V1\OrderDetailController;
use App\Http\Controllers\Api\V1\OrderListController;
use App\Http\Controllers\Api\V1\SaveOrderController;
use App\Http\Controllers\Api\V1\ProviderDetailController;
use App\Http\Controllers\Api\V1\ProviderListController;
use App\Http\Controllers\Api\V1\ServiceListController;
use App\Http\Controllers\Api\V1\SaveServiceController;
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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    Route::post('comments', SaveCommentController::class)->name('comment.save');
    Route::get('/comments', CommentListController::class)->name('comment.list');
    Route::post('/customers', SaveCustomerController::class)->name('customer.save');
    Route::get('/customers', CustomerListController::class)->name('customer.list');
    Route::get('/providers', ProviderListController::class)->name('provider.list');
    Route::get('/providers/{provider}', ProviderDetailController::class)->name('provider.detail');
    Route::get('/orders', OrderListController::class)->name('order.list');
    Route::get('/orders/{order}', OrderDetailController::class)->name('order.detail');
    Route::post('/orders', SaveOrderController::class)->name('order.save');
    Route::post('/services', SaveServiceController::class)->name('service.save');
    Route::get('/services', ServiceListController::class)->name('service.list');
});

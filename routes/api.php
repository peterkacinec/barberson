<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CommentListController;
use App\Http\Controllers\Api\V1\CommentSaveController;
use App\Http\Controllers\Api\V1\CustomerListController;
use App\Http\Controllers\Api\V1\CustomerSaveController;
use App\Http\Controllers\Api\V1\OrderDetailController;
use App\Http\Controllers\Api\V1\OrderListController;
use App\Http\Controllers\Api\V1\OrderSaveController;
use App\Http\Controllers\Api\V1\ProviderDetailController;
use App\Http\Controllers\Api\V1\ProviderListController;
use App\Http\Controllers\Api\V1\ServiceListController;
use App\Http\Controllers\Api\V1\ServiceSaveController;
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
    Route::post('comments', CommentSaveController::class)->name('comment.save');
    Route::get('/comments', CommentListController::class)->name('comment.list');
    Route::post('/customers', CustomerSaveController::class)->name('customer.save');
    Route::get('/customers', CustomerListController::class)->name('customer.list');
    Route::get('/providers', ProviderListController::class)->name('provider.list');
    Route::get('/providers/{provider}', ProviderDetailController::class)->name('provider.detail');
    Route::get('/orders', OrderListController::class)->name('order.list');
    Route::get('/orders/{order}', OrderDetailController::class)->name('order.detail');
    Route::post('/orders', OrderSaveController::class)->name('order.save');
    Route::post('/services', ServiceSaveController::class)->name('service.save');
    Route::get('/services', ServiceListController::class)->name('service.list');
});

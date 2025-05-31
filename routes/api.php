<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\MerchandiseCategoryController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\MerchandiseOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:api']);

/**
 * Route user without auth
 */
Route::apiResource('article', ArticleController::class)->only(['show', 'index']);

Route::prefix('merchandise')->group(function () {
    Route::apiResource('/', MerchandiseController::class)->only(['show', 'index']);
    Route::apiResource('/category', MerchandiseCategoryController::class)->only(['show', 'index']);
});

Route::apiResource('emergency', EmergencyRequestController::class)->only(['show', 'index', 'store']);


/**
 * Route user with auth
 */
Route::middleware(['auth:api'])->group(function () {
    
     Route::apiResource('merchandise/order', MerchandiseOrderController::class)->only(['store', 'show', 'index', 'update']);
 
     Route::apiResource('complaint', ComplaintController::class);


/**
 * Route admin
 */
 Route::middleware(['role:admin'])->group(function () {
    Route::prefix('merchandise')->group(function () {
        Route::apiResource('/', MerchandiseController::class);
        Route::apiResource('/category', MerchandiseCategoryController::class);
        Route::apiResource('/order', MerchandiseOrderController::class);
    });

    Route::apiResource('article', ArticleController::class);
 
    Route::apiResource('complaint', ComplaintController::class);

    Route::apiResource('emergency', EmergencyRequestController::class);

    Route::apiResource('users', UserController::class);
 });

});
<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\MerchandiseOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Route guest/umum
 */
Route::apiResource('article', ArticleController::class)->only(['index', 'show']);
Route::apiResource('merchandise', MerchandiseController::class)->only(['index', 'show']);
Route::apiResource('merchandiseorder', MerchandiseOrderController::class)->only(['index', 'show']);
Route::apiResource('category', MerchandiseCategoryController::class)->only(['index', 'show']);

/**
 * Route Khusus Auth
 * */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


/**
 * Route User Profile (self)
 */
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::delete('/user/profile', [UserController::class, 'destroyOwnAccount']);
});


/**
 * Route user login only
 */
Route::middleware(['auth:api', 'role:user'])->group(function () {
    Route::apiResource('complaint', ComplaintController::class)->only(['index', 'show', 'store']);
    Route::apiResource('emergency', EmergencyRequestController::class)->only(['store']);
    Route::post('merchandiseorder', [MerchandiseOrderController::class, 'store']);
    Route::delete('merchandiseorder/{id}', [MerchandiseOrderController::class, 'destroy']);
});


/**
 * Route admin only
 */
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/article', [ArticleController::class, 'store']);
    Route::put('/article/{id}', [ArticleController::class, 'update']);
    Route::delete('/article/{id}', [ArticleController::class, 'destroy']);

    Route::apiResource('complaint', ComplaintController::class)->except(['store']);
    Route::apiResource('emergency', EmergencyRequestController::class)->except(['store']);
    Route::apiResource('users', UserController::class)->only(['index', 'show', 'destroy']);

    Route::post('/merchandise', [MerchandiseController::class, 'store']);
    Route::put('/merchandise/{id}', [MerchandiseController::class, 'update']);
    Route::delete('/merchandise/{id}', [MerchandiseController::class, 'destroy']);

    Route::post('/category', [MerchandiseCategoryController::class, 'store']);
    Route::put('/category{id}', [MerchandiseCategoryController::class, 'update']);
    Route::delete('/category{id}', [MerchandiseCategoryController::class, 'destroy']);

    Route::put('/order/{id}', [MerchandiseOrderController::class, 'update']);
    Route::delete('/order/{id}', [MerchandiseOrderController::class, 'destroy']);
});

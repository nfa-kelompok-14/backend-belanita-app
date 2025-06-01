<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Route guest/umum
 */
Route::apiResource('article', ArticleController::class)->only(['index', 'show']);
Route::apiResource('merchandise', MerchandiseController::class)->only(['index', 'show']);


/**
 * Route Khusus Auth
 */
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

/**
 * Route User Profile (self)
 */
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::delete('/user/profile', [UserController::class, 'destroyOwnAccount']);
});


/**
 * Route user login only
 */
Route::middleware('auth:api')->group(function () {
    Route::apiResource('complaint', ComplaintController::class)->only(['index', 'show', 'store']);
    Route::apiResource('emergency', EmergencyRequestController::class)->only(['store']);
});

/**
 * Route admin only
 */
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/article', [ArticleController::class, 'store']);
    Route::put('/article/{id}', [ArticleController::class, 'update']);
    Route::delete('/article/{id}', [ArticleController::class, 'destroy']);

    Route::apiResource('complaint', ComplaintController::class)->except(['index', 'show', 'store']);
    Route::apiResource('emergency', EmergencyRequestController::class)->except(['index', 'show', 'store']);
    Route::apiResource('users', UserController::class)->only(['index', 'show', 'destroy']);
});

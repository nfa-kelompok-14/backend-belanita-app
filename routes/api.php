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
 * Route Khusus Auth
 */
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

/**
 * Route guest/umum
 */
Route::apiResource('article', ArticleController::class)->only(['show', 'index']);
Route::apiResource('merchandise', MerchandiseController::class)->only(['show', 'index']);

/**
 * Route user login only
 */
Route::middleware('auth:api')->group(function () {
    Route::post('/auth/profile', [AuthController::class, 'updateProfile']);
    Route::delete('/auth/profile', [AuthController::class, 'destroyOwnAccount']);
    Route::apiResource('complaint', ComplaintController::class);
    Route::apiResource('emergency', EmergencyRequestController::class)->only(['show', 'index', 'store']);
});

/**
 * Route admin only
 */
Route::middleware(['role:admin'])->group(function () {
    Route::apiResource('complaint', ComplaintController::class);
    Route::apiResource('emergency', EmergencyRequestController::class);
    Route::apiResource('users', UserController::class);
    Route::delete('user/{id}', [UserController::class, 'destroyUser']);
});

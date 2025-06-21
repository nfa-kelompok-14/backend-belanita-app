<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\MerchandiseCategoryController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\MerchandiseOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
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
Route::apiResource('category', MerchandiseCategoryController::class)->only(['index', 'show']);

/**
 * Route Khusus Auth
 * */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');


/**
 * Route user and admin
 */
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::delete('/user/profile', [UserController::class, 'destroyOwnAccount']);

    Route::apiResource('complaint', ComplaintController::class)->only(['index', 'show']);
    Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy']);


    Route::get('/order', [MerchandiseOrderController::class, 'index']);
    Route::get('/order/{id}', [MerchandiseOrderController::class, 'show']);

    Route::get('/emergency', [EmergencyRequestController::class, 'index']);
    Route::get('/emergency/{id}', [EmergencyRequestController::class, 'show']);
    Route::delete('/emergency/{id}', [EmergencyRequestController::class, 'destroy']);

});


Route::middleware(['auth:api', 'role:user'])->group(function () {
    Route::post('/complaint', [ComplaintController::class, 'store']);

    Route::post('/order', [MerchandiseOrderController::class, 'store']);

    Route::patch('/balance', [UserController::class, 'addBalance']);

    Route::post('/emergency', [EmergencyRequestController::class, 'store']);
});

/**
 * Route admin only
 */
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/article', [ArticleController::class, 'store']);
    Route::put('/article/{slug}', [ArticleController::class, 'update']);
    Route::delete('/article/{id}', [ArticleController::class, 'destroy']);


    Route::put('/complaint/{id}', [ComplaintController::class, 'update']);

    Route::apiResource('emergency', EmergencyRequestController::class)->only(['update', 'destroy']);
    Route::apiResource('users', UserController::class)->only(['index', 'show', 'destroy']);
    Route::apiResource('feedback', FeedbackController::class);

    Route::post('/merchandise', [MerchandiseController::class, 'store']);
    Route::put('/merchandise/{id}', [MerchandiseController::class, 'update']);
    Route::delete('/merchandise/{id}', [MerchandiseController::class, 'destroy']);

    Route::post('/category', [MerchandiseCategoryController::class, 'store']);
    Route::put('/category/{id}', [MerchandiseCategoryController::class, 'update']);
    Route::delete('/category/{id}', [MerchandiseCategoryController::class, 'destroy']);

    Route::put('/order/{id}', [MerchandiseOrderController::class, 'update']);
    Route::delete('/order/{id}', [MerchandiseOrderController::class, 'destroy']);
    Route::put('/emergency', [EmergencyRequestController::class, 'update']);

});

<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EmergencyRequestController;
use App\Http\Controllers\MerchandiseCategoryController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\MerchandiseOrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * Merchandise Route
 * Used for getting all data with index().
 * Used for update data based id with update()
 * Used for create new data with store().
 * User for delete data based id with destroy().
 * Used for show one data with show().
 */

 Route::prefix('merchandise')->group(function () {
     Route::apiResource('/', MerchandiseController::class);
     Route::apiResource('/category', MerchandiseCategoryController::class);
     Route::apiResource('/order', MerchandiseOrderController::class);
 });


/**
 * Article Route
 * Used for getting all data with index().
 * Used for update data based id with update()
 * Used for create new data with store().
 * User for delete data based id with destroy().
 * Used for show one data with show().
 */

 Route::apiResource('article', ArticleController::class);


/**
 * Complaint Route
 * Used for getting all data with index().
 * Used for update data based id with update()
 * Used for create new data with store().
 * User for delete data based id with destroy().
 * Used for show one data with show().
 */

 Route::apiResource('complaint', ComplaintController::class);

 
/**
 * Emergency Route
 * Used for getting all data with index().
 * Used for update data based id with update()
 * Used for create new data with store().
 * User for delete data based id with destroy().
 * Used for show one data with show().
 */

 Route::apiResource('emergency', EmergencyRequestController::class);


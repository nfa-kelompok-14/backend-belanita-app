<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\MerchandiseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



/**
 * Merchandise API
 * Used for getting all data with get().
 * Used for update data based id with put().
 * Used for create new data post().
 * User for delete data based id delete().
 */


Route::prefix('merchandise')->group(function () {
     Route::get('/index', [MerchandiseController::class, 'index']);

     Route::put('/update/{id}', [MerchandiseController::class, 'update']);
    
     Route::post('/store', [MerchandiseController::class, 'store']);
    
     Route::delete('/destroy/{id}', [MerchandiseController::class, 'destroy']);
 });


/**
 * Article API
 * Used for getting all data with get().
 * Used for update data based id with put().
 * Used for create new data post().
 * User for delete data based id delete().
 */


Route::prefix('article')->group(function () {
     Route::get('/index', [ArticleController::class, 'index']);
     Route::put('/update/{id}', [ArticleController::class, 'update']);
    
     Route::post('/store', [ArticleController::class, 'store']);
    
     Route::delete('/destroy/{id}', [ArticleController::class, 'destroy']);
 });


/**
 * Complaint API
 * Used for getting all data with get().
 * Used for update data based id with put().
 * Used for create new data post().
 * User for delete data based id delete().
 */


Route::prefix('complaint')->group(function () {
     Route::get('/index', [ComplaintController::class, 'index']);
     Route::put('/update/{id}', [ComplaintController::class, 'update']);
    
     Route::post('/store', [ComplaintController::class, 'store']);
    
     Route::delete('/delete/{id}', [ComplaintController::class, 'delete']);
 });
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\ProductApiController;
use App\Http\Controllers\API\SalesOrderApiController;

// User Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// User After Auth routes
Route::middleware('auth:api')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::post('/sales-orders', [SalesOrderApiController::class, 'store']);
    Route::get('/sales-orders/{id}', [SalesOrderApiController::class, 'show']);
});

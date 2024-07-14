<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use Tymon\JWTAuth\Http\Middleware\Authenticate as JWTAuthenticate;
use App\Http\Controllers\SaleController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
//Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');


#Product
// Apply the JWT middleware to the group of routes
Route::middleware([JWTAuthenticate::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::post('products', [ProductController::class, 'store']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    #Purchase
    Route::post('purchases', [PurchaseController::class, 'store']);
    Route::get('purchases', [PurchaseController::class, 'index']);

    #Sales
    Route::post('sales', [SaleController::class, 'store']);
    Route::get('sales', [SaleController::class, 'index']);

});

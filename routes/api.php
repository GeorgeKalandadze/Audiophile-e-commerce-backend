<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductsController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',[AuthController::class,'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/products',[ProductsController::class,'index']);
    Route::post('/cart/add', [CartController::class,'add']);
    Route::get('/cart/get-carts', [CartController::class,'getCarts']);
    Route::put('/cart/update-quantity/{cart_id}/{scope}', [CartController::class,'updateQuantity']);

});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);




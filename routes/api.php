<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductsController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\CheckoutController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\Auth\RegisteredUserController;
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
    Route::prefix('cart')->group(function () {
        Route::post('/add', [CartController::class,'add']);
        Route::get('/get-carts', [CartController::class,'getCarts']);
        Route::put('/update-quantity/{cart_id}/{scope}', [CartController::class,'updateQuantity']);
        Route::delete('/delete-cart', [CartController::class,'deleteAllCartItem']);
    });
    Route::post('/checkout', [CheckoutController::class, 'checkout']);
    Route::post('/customers', [CustomerController::class, 'store']);

});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);




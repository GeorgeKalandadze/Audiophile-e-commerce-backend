<?php

namespace App\Http\Controllers;
use App\Http\Resources\CartItemResource;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $user = $request->user();
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        if ($user) {
            $productCheck = Product::where('id', $product_id)->first();

            if ($productCheck) {
                if (CartItem::where('product_id', $product_id)->where('user_id', $user->id)->exists()) {
                    // Debug Statement 1

                    return response()->json([
                        'message' => 'Already added to cart'
                    ],409);
                } else {
                    $data = [
                        'user_id' => $request->user()->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                    ];
                    CartItem::create($data);
                    $cartItems = CartItem::with('product')
                        ->where('user_id', $user->id)
                        ->get();
                }
                return response()->json([
                    'data' => CartItemResource::collection($cartItems),
                    'message' => 'Added to cart'
                ],201);
            } else {

                return response()->json([
                    'message' => 'Product not found'
                ],404);
            }
        }
    }

    public function updateQuantity($cart_id, $scope, Request $request)
    {
        $user = $request->user();
        if($user){
            $user_id = $user->id;
            $cartItem = CartItem::where('id',$cart_id)->where('user_id',$user_id)->first();
            if($cartItem){
                if($scope == "inc"){
                    $cartItem->quantity += 1;
                }else if($scope == "dec"){
                    if($cartItem->quantity > 0) {
                        $cartItem->quantity -= 1;
                        if($cartItem->quantity == 0) {
                            $cartItem->delete();
                            return response()->json([

                                'message' => 'cart item deleted'
                            ],201);
                        }
                    }
                    else {
                        return response()->json([
                            'status' => 400,
                            'message' => 'quantity cannot be decreased below zero'
                        ]);
                    }
                }
                $cartItem->update();
                $cartItems = CartItem::with('product')
                    ->where('user_id', $user->id)
                    ->get();
                return response()->json([
                    'data' => $cartItems,
                    'message' => 'quantity updated'
                ],201);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'cart item not found'
                ]);
            }
        }
    }


    public function getCarts(Request $request)
    {
        $user = $request->user();
        if($user){
            $user_id = $user->id;
            $cartItems = CartItem::with('product')
                ->where('user_id', $user_id)
                ->get();
            return CartItemResource::collection($cartItems);
        }
    }

    public function deleteAllCartItem(Request $request)
    {
        $user = $request->user();
        if ($user) {
            CartItem::where('user_id', $user->id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Cart cleared'
            ]);
        }
    }
}

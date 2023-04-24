<?php

namespace App\Http\Controllers;
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
                    return response()->json([
                        'status' => 409,
                        'message' => 'Already added to cart'
                    ]);
                } else {
                    $data = [
                        'user_id' => $request->user()->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                    ];
                    CartItem::create($data);
                }

                return response()->json([
                    'status' => 201,
                    'message' => 'Added to cart'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Product not found'
                ]);
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
                    $cartItem->quantity -= 1;
                }
                $cartItem->update();
                return response()->json([
                    'status' => 201,
                    'message' => 'quantity updated'
                ]);
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
            return response()->json($cartItems);
        }
    }

}

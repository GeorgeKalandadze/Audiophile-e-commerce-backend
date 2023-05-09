<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {
        $user = $request->user();

        [$products, $cartItems] = self::getProductsAndCartItems();

        $orderItems = [];

        $totalPrice = 0;
        foreach ($products as $product) {
            $quantity = $cartItems[$product->id]['quantity'];
            $totalPrice += $product->price * $quantity;

            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price
            ];
        }

        // Check if the user already has an order with a status of "Completed"
        $existingOrder = Order::where('created_by', $user->id)
            ->where('status', OrderStatus::Completed)
            ->first();

        if ($existingOrder) {
            // The user already has a completed order, create a new order
            $orderData = [
                'total_price' => $totalPrice,
                'status' => OrderStatus::Unpaid,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            $order = Order::create($orderData);

            // Create Order Items for the new order
            foreach ($orderItems as $orderItem) {
                $orderItem['order_id'] = $order->id;
                OrderItem::create($orderItem);
            }
        } else {
            // Check if the user already has an order with a status of "Unpaid"
            $existingOrder = Order::where('created_by', $user->id)
                ->where('status', OrderStatus::Unpaid)
                ->first();

            if ($existingOrder) {
                // Add order items to the existing "Unpaid" order
                foreach ($orderItems as $orderItem) {
                    $orderItem['order_id'] = $existingOrder->id;
                    OrderItem::create($orderItem);
                }
            } else {
                // Create a new order for the user
                $orderData = [
                    'total_price' => $totalPrice,
                    'status' => OrderStatus::Unpaid,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ];
                $order = Order::create($orderData);

                // Create Order Items for the new order
                foreach ($orderItems as $orderItem) {
                    $orderItem['order_id'] = $order->id;
                    OrderItem::create($orderItem);
                }
            }
        }

        CartItem::where(['user_id' => $user->id])->delete();
        
        return Order::with('items', 'items.product')
            ->where('created_by', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }



    public static function getCookieCartItems()
    {
        $request = \request();
        return json_decode($request->cookie('cart_items', '[]'), true);
    }

    public static function getCartItems()
    {
        $request = \request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->get()->map(
                fn($item) => ['product_id' => $item->product_id, 'quantity' => $item->quantity]
            );
        } else {
            return self::getCookieCartItems();
        }
    }

    public static function getProductsAndCartItems(): array|\Illuminate\Database\Eloquent\Collection
    {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::query()->whereIn('id', $ids)->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');

        return [$products, $cartItems];
    }
}

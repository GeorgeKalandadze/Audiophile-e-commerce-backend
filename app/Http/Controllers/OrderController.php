<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $data = Order::with('items', 'items.product')
            ->where('created_by', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
        return response()->json([
            'data' => $data,
            'message' => 'get order'
            ],200);
    }
}

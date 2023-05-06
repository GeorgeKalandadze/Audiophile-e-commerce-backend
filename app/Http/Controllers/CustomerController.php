<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\CustomerInfoRequest;
use App\Models\Customer;
use App\Models\Order;


class CustomerController extends Controller
{
    public function store(CustomerInfoRequest $request)
    {
        $validatedData = $request->validated();

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'zip_code' => $validatedData['zip_code'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'e_money_number' => $validatedData['e_money_number'],
            'e_money_pin' => $validatedData['e_money_pin'],
            'payment_details' => $validatedData['payment_details']?? null,
        ]);

        $user = $request->user();
        $order = Order::where('created_by', $user->id)->first();
        if($order){
            $order->status = OrderStatus::Completed;
            $order->save();
        }
        return response()->json([
            'success' => true,
            'customer' => $customer,
        ], 201);
    }
}

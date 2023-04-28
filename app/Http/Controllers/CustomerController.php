<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerInfoRequest;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function store(CustomerInfoRequest $request)
    {
        $validatedData = $request->validated();

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'zip_code' => $validatedData['zip_code'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'e_money_number' => $validatedData['e_money_number'],
            'e_money_pin' => $validatedData['e_money_pin'],
            'payment_details' => $validatedData['payment_details'],
        ]);

        return response()->json([
            'success' => true,
            'customer' => $customer,
        ], 201);
    }
}

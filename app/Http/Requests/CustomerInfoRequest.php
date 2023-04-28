<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $authorizedUser = Auth::user();
        return [
            'name' => [ 'required', Rule::in([$authorizedUser->name])],
            'email' => ['required', Rule::in([$authorizedUser->email])],
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'e_money_number' => 'required|string|max:255',
            'e_money_pin' => 'required|string|max:255',
            'payment_details' => ['nullable', 'string', Rule::in(['e-Money', 'e-Money PIN'])]
        ];
    }
}

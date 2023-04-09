<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->symbols()
                    ->numbers()
            ],
            'avatar_image' => [

                'image',
                'mimes:jpeg,png,jpg',
                'max:2048', // maximum file size in kilobytes
            ],

        ];
    }

    public function messages(){
        return [
            'name.required' => 'your name is required please enter name',
            'password.required' => 'your password is incorrect',

        ];
    }
}

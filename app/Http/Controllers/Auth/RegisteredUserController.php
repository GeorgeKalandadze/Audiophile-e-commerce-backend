<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function store(SignupRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar_image' => $this->storeImage($request),
        ]);
        event(new Registered($user));
        Auth::login($user);
        return response()->json([
            'status' => 201,
            'message' => 'registered'
        ]);
    }

    private function storeImage($request)
    {
        $newImageName = uniqid() . '-' . time() . '.' . $request->avatar_image->extension();
        $request->avatar_image->move(public_path('avatar_images'), $newImageName);
        return $newImageName;

    }
}

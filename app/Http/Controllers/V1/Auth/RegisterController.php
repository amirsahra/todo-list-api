<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $registerRequest, User $userModel)
    {
        $userData = $registerRequest->only(
            'first_name', 'last_name', 'gender', 'password', 'phone', 'email', 'avatar', 'birthday'
        );

        $newUser = $userModel->createUser($userData);

        $token = $newUser->createToken('API Token')->accessToken;

        event(new Registered($newUser));

        return response()->apiResult(
            __('messages.register.success'),
            ['user' => $newUser, 'token' => $token]
        ); //TODO return user resource
    }
}

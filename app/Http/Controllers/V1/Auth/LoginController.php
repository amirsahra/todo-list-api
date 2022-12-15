<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest)
    {
        if (!auth()->attempt($loginRequest->only('email', 'password'))) {
            return response()->apiResult(__('messages.login.error'), null, false, 401);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->apiResult(__('messages.login.success'),
            ['user' => auth()->user(), 'token' => $token]); //TODO return user resource
    }

}

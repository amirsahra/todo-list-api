<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->only('login');
    }

    public function login(LoginRequest $loginRequest)
    {
        auth()->attempt($loginRequest->only('email', 'password'));

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->apiResult(
            __('messages.login.success'),
            ['user' => new UserResource(auth()->user()), 'token' => $token]
        );
    }

    public function logout()
    {
        $token = Auth::guard('api')->user()->token();
        $token->revoke();
        return response()->apiResult(__('messages.logout'));
    }

}


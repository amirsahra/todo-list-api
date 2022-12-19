<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->only('login');
    }

    public function login(LoginRequest $loginRequest)
    {
        if (!auth()->attempt($loginRequest->only('email', 'password'))) {
            return response()->apiResult(__('messages.login.error'), null, false, 401);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->apiResult(
            __('messages.login.success'),
            ['user' => auth()->user(), 'token' => $token]
        ); //TODO return user resource
    }

    public function logout()
    {
        $token = Auth::guard('api')->user()->token();
        $token->revoke();
        return response()->apiResult(__('messages.logout'));
    }

}


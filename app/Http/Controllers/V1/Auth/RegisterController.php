<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke(RegisterRequest $registerRequest)
    {
        $userData = $registerRequest
            ->only('first_name','last_name','gender','status','type','');
        $userData['password'] = Hash::make($registerRequest->get('password'));

        $user = User::create($userData);

        $token = $user->createToken('API Token')->accessToken;

        return response()->apiResult(__('messages.register.success'),
            ['user' => auth()->user(), 'token' => $token]); //TODO return user resource
    }
}

<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use HasImage;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use HasImage;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $registerRequest)
    {
        $userData = $registerRequest->only('first_name','last_name','gender','status','type','');
        $userData['password'] = Hash::make($registerRequest->get('password'));

        $avatarPath = null;
        if ($registerRequest->has('avatar'))
            $avatarPath = $this->uploadImage($registerRequest->avatar, 'avatar');

        $userData['avatar'] = $avatarPath;

        $user = User::create($userData);

        $token = $user->createToken('API Token')->accessToken;

        return response()->apiResult(
            __('messages.register.success'),
            ['user' => auth()->user(), 'token' => $token]
        ); //TODO return user resource
    }
}

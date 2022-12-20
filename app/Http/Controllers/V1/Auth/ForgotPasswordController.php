<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\PasswordResetRequest;
use App\Http\Requests\V1\Auth\SendResetLinkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    protected function sendResetLink(SendResetLinkRequest $request)
    {
        $result = $request->validate(['email' => 'required|email']);
        Password::sendResetLink($result);
        return response()->apiResult(
            __('messages.reset_link'),
            $result
        );
    }

    protected function passwordReset(PasswordResetRequest $request,)
    {
        $input = $request->only('email','token', 'password', 'password_confirmation');

        $result = Password::reset($input, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        return response()->apiResult(
            __('messages.reset_success'),
            $result
        );
    }
}

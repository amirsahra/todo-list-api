<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'signed']);
    }

    public function VerifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return response()->apiResult(
            __('messages.email.verify_email.success'),
        );
    }
}

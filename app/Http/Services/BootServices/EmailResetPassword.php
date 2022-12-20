<?php

namespace App\Http\Services\BootServices;

use App\Http\Contracts\EmailService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class EmailResetPassword extends EmailService
{
    public function __invoke()
    {
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = route('password.reset',$token).'?email='.$notifiable->getEmailForPasswordReset();
            return (new MailMessage())
                ->subject('Password reset')
                ->view('emails.reset', compact('url'));
        });
    }
}

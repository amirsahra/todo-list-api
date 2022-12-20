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
            //$url = route('password.reset',$token).'?email='.$notifiable->getEmailForPasswordReset();
            $data=[
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
                'reset_url' => route('password.reset'),
            ];
            return (new MailMessage())
                ->subject(__('messages.email.rest_password.subject'))
                ->view('emails.reset', compact('data'));
        });
    }
}

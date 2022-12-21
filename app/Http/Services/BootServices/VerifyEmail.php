<?php

namespace App\Http\Services\BootServices;

use App\Http\Contracts\EmailService;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyMail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends EmailService
{
    public function __invoke()
    {
        VerifyMail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(__('messages.email.verify_email.subject'))
                ->line(__('messages.email.verify_email.content'))
                ->action('Verify Email Address', $url)
                ->view('emails.verify', compact('url'));
        });
    }
}

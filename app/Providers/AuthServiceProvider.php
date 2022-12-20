<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Services\BootServices\EmailResetPassword;
use App\Http\Traits\EmailSender;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use EmailSender;

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     * @throws \App\Exceptions\NotFoundServiceClass
     */
    public function boot()
    {
        $this->registerPolicies();

        //Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        //Passport::hashClientSecrets();

        // custom reset password email
        $this->sendMailWithServiceName(EmailResetPassword::class);


    }
}

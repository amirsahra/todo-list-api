<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('apiResult', function ($message, $data = null, $success = true, $status = 200) {
            return Response::json([
                'success' => $success,
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ], $status);
        });
    }
}

<?php

use App\Http\Controllers\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1/'],function (){
    Route::post('login',[LoginController::class,'login']);
    Route::post('register',[RegisterController::class,'register']);

    Route::middleware('auth:api')->group(function () {
        Route::get('logout',[LoginController::class,'logout']);
        Route::post('password/send-link',[ForgotPasswordController::class,'sendResetLink']);
        Route::post('password/reset', [ForgotPasswordController::class ,'passwordReset'])->name('password.reset');

    });



});


<?php

use App\Http\Controllers\V1\Auth\EmailVerifyController;
use App\Http\Controllers\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\TaskController;
use App\Http\Controllers\V1\UserController;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'v1/'],function (){
    Route::post('login',[LoginController::class,'login']);
    Route::post('register',[RegisterController::class,'register']);
    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class,'VerifyEmail'])
        ->name('verification.verify');
    Route::post('password/send-link',[ForgotPasswordController::class,'sendResetLink']);
    Route::post('password/reset', [ForgotPasswordController::class ,'passwordReset'])
        ->name('password.reset');

    Route::get('logout',[LoginController::class,'logout'])->middleware(['auth:api']);
    Route::middleware(['auth:api','verified'])->group(function () {
        Route::apiResource('task', TaskController::class);
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('user', UserController::class)->except('store');

    });

});


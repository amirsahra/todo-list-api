<?php

use App\Http\Controllers\V1\Auth\EmailVerifyController;
use App\Http\Controllers\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\TaskController;
use App\Http\Controllers\V1\UserController;
use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('test',function (){
    $executionTime = Carbon::now()
        ->addMinutes(config('todosettings.time_permit.min'));
    $format = $executionTime->format('Y-m-d h:i:s');
    $usersTaskExecutionTime = Task::whereDate('execution_time', '=', $format)
        //->where('execution_time','=',$format)
        ->count();

    return response(
        $usersTaskExecutionTime
    );
});

Route::group(['prefix'=>'v1/'],function (){
    Route::post('login',[LoginController::class,'login']);
    Route::post('register',[RegisterController::class,'register']);
    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class,'VerifyEmail'])
        ->name('verification.verify');
    Route::post('password/send-link',[ForgotPasswordController::class,'sendResetLink']);
    Route::post('password/reset', [ForgotPasswordController::class ,'passwordReset'])
        ->name('password.reset');


    Route::middleware(['auth:api','verified'])->group(function () {
        Route::get('logout',[LoginController::class,'logout']);
        Route::apiResource('task', TaskController::class);
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('user', UserController::class)->except('store');

    });



});


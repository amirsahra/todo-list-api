<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $info = array(
        'name' => "Alex"
    );
    Mail::send(['html' => 'emails.verify-email'], $info, function ($message)
    {
        $message->to('alex@example.com', 'W3SCHOOLS')
            ->subject('Basic test eMail from W3schools.');
        $message->from('sender@example.com', 'Alex');
    });
    echo "Successfully sent the email";
});

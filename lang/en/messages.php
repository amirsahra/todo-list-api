<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Display messages for requests
    |--------------------------------------------------------------------------
    |
    | For multilingual and comprehensive messages,
    | put the text of the message in this file with a unique key and call it when needed.
    |
    */
    'validate_error' => 'Incorrect Details, Please try again.',

    'login' => [
        'success' => 'You have successfully logged in.',
    ],
    'logout' => 'You have been successfully logged out!',
    'reset_link' => 'Reset password link sent on your email',
    'register' => [
        'success' => 'You have successfully registered.',
    ],

    'email' => [
        'verify_email' => [
            'title' => 'Welcome to Todo list',
            'content' => "Hello :name <br> You must confirm your email to complete the registration process.".
                         "<br>So click on the button below to confirm your email",
        ],
        'rest_password' => [
            'subject' => 'Password reset',
            'title' => 'Hello my friend',
            'content' => "You are receiving this email because we received a password reset request for your account.".
                "\nThis password reset link will expire in 60 minutes.".
                "\nIf you did not request a password reset, no further action is required",
        ],
    ],

    'boolean' => 'The :attribute field must be true or false.',


];

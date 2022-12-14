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
    'validate_authorized' => 'This action is unauthorized.',
    'unauthorized' => 'You do not have permission to access or perform this action.',
    'unauthenticated' => 'You do not have permission to access. You must login first',

    'method' => [
        'index' => 'Display a listing of the :name.',
        'show' => 'Show :name.',
        'store' => 'Create :name successfully.',
        'update' => 'Edit :name successfully.',
        'destroy' => 'Delete :name successfully.',
    ],

    'login' => [
        'success' => 'You have successfully logged in.',
    ],
    'logout' => 'You have been successfully logged out!',
    'reset_link' => 'Reset password link sent on your email',
    'reset_success' => 'Reset password successfully,',
    'register' => [
        'success' => 'You have successfully registered.',
    ],

    'email' => [
        'verify_email' => [
            'success' => 'Your email has been successfully verified.',
            'title' => 'Welcome to Todo list',
            'content' => "Hello \n You must confirm your email to complete the registration process." .
                "\nSo click on the button below to confirm your email",
        ],
        'rest_password' => [
            'subject' => 'Password reset',
            'title' => 'Hello my friend',
            'content' => "You are receiving this email because we received a password reset request for your account." .
                "\nThis password reset link will expire in 60 minutes." .
                "\nIf you did not request a password reset, no further action is required",
        ],'
        execution' => [
            'subject' => 'Execution time',
            'title' => 'Task time reminder',
            'content' => "This email is only to remind you of your task.",
        ],
    ],

    'boolean' => 'The :attribute field must be true or false.',


];

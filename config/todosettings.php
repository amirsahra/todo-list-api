<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default admin information
    |--------------------------------------------------------------------------
    |
    | We need an admin user for management and testing.
    | By default, a user will be created with the information below.
    | If needed, you can personalize this information.
    |
    */
    'default_admin' => [
        'first_name' => 'Super',
        'last_name' => 'Admin',
        'gender' => 'male',
        'type' => 'admin',
        'avatar' => 'admin.png',
        'phone' => '98 3030',
        'email' => 'amirhosein.sahra@gmail.com',
        'password' =>'123456789',
    ],

    /*
    |--------------------------------------------------------------------------
    | Insert fake data
    |--------------------------------------------------------------------------
    |
    | If you want the fake data not to be created,
    | change the value of the variable to false.
    |
    */
    'create_default_admin' => true,
    'create_fake_member' => true,
    'create_fake_category' => true,
    'create_fake_task' => true,

    /*
    |--------------------------------------------------------------------------
    | Number of fake data
    |--------------------------------------------------------------------------
    |
    | You can determine the number of fake data of different tables in the following variables.
    |
    */
    'number_fake_data' => [
        'user' => 19,
        'tasks' => 100,
        'category' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Number of pagination
    |--------------------------------------------------------------------------
    |
    | You can set the number of views of each section.
    |
    */
    'paginate' => [
        'user' => 10,
        'tasks' => 10,
        'category' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Image path
    |--------------------------------------------------------------------------
    |
    | If you want to use images, you can specify its public address.
    |
    */
    'path' => [
        'avatar' => 'images/avatars/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Min and Max time for task
    |--------------------------------------------------------------------------
    |
    | You can set a value for the minimum and maximum task interval.
    | For example, specify that there should be at least 30 minutes between
    | now and the task execution time.
    |
    */
    'time_permit' => [
        'min' => 30, // minutes
        'max' => '1 years',
    ],

];

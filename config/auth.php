<?php

return [

    'defaults' => [
        'guard' => 'web',       // default for users
        'passwords' => 'users', // default password broker
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // ✅ Admin guard
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // uses the admins provider below
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // ✅ Admin provider
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, // make sure this model exists
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // ✅ Optional: password reset for admins
        'admins' => [
            'provider' => 'admins',
            'table' => 'admin_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];

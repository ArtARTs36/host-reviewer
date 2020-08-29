<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'basic',
            'provider' => 'users',
            'redirect' => '/auth',
            'ttl' => 3600,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
        ],
    ],
];

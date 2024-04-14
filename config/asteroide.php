<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global storage disk
    |--------------------------------------------------------------------------
    |
    |
    */

    'public_storage' => env('FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Secure disk
    |--------------------------------------------------------------------------
    |
    |
    */

    'private_storage' => env('FILESYSTEM_SECURE_DISK', 's3_secure'),

    /*
    |--------------------------------------------------------------------------
    | Account config
    |--------------------------------------------------------------------------
    |
    |
    */

    'account' => [
        'home' => '/productos',
        'prefix' => 'account',
        'guard' => 'account',
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Providers
    |--------------------------------------------------------------------------
    |
    |
    */
    'payments' => [
        'stripe' => [
            'key' => env('STRIPE_KEY'),
            'secret' => env('STRIPE_SECRET'),
        ],
        'paypal' => [
            'client' => env('PAYPAL_CLIENT'),
            'secret' => env('PAYPAL_SECRET'),
            'mode' => env('PAYPAL_MODE', 'sandbox'),
        ],
        'conekta' => [
            'key' => env('CONEKTA_KEY'),
            'secret' => env('CONEKTA_SECRET'),
        ],
    ],
];

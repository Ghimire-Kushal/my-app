<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    */

    'default' => env('MAIL_MAILER', 'resend'), // ✅ force resend

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    */

    'mailers' => [

        // ❌ NOT USED (but keep for fallback)
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST'),
            'port' => env('MAIL_PORT'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
        ],

        // ✅ RESEND (MAIN)
        'resend' => [
            'transport' => 'resend',
        ],

        // fallback
        'log' => [
            'transport' => 'log',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Addresss
    |--------------------------------------------------------------------------
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev'),
        'name' => env('MAIL_FROM_NAME', 'Kushal Portfolio'),
    ],

];
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1472127286562940',  //client face của bạn
        'client_secret' => '63c9f1d2582237a03df77269993aefc6',  //client app service face của bạn
        'redirect' => 'http://nguyenlevinh.com/shop/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '1021068342916-a4kkopdmhrdr6o1dbhbs6cbpd1o26l3n.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://nguyenlevinh.com/shop/google/callback'
    ],



];

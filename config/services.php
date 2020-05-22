<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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
    'facebook' => [
        'client_id' => '533488740863959',
        'client_secret' => 'd94fd6e3542be599696d3f5704f35b6d',
        'redirect' => 'https://www.apay.somadevoos.com/auth/facebook/callback'
    ],
    'google' => [
        'client_id' => '536868857650-sqgehi9jsi0959bd207aepq0iv0cpekh.apps.googleusercontent.com',
        'client_secret' => 'JGHBR2_9wC8o75ELRhNspD7u',
        'redirect' => 'https://www.apay.somadevoos.com/auth/google/callback/',
    ],
];

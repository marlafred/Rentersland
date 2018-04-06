<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
        'client_id' => '1797563786982549',
        'client_secret' => 'b5cc38e19e2f0bfa8e4ac03374782b8d',
        'redirect'=>'https://rentersland.com/login/facebook/callback'
    ],
    
    //https://console.developers.google.com/apis/credentials/wizard?api=plus.googleapis.com&project=lenters-app
    
    'google' => [
        'client_id' => '730054891374-u6o0s3022bqdmqnup1402gtpi7e3hp14.apps.googleusercontent.com',
        'client_secret' => '52xZn2FL3-3YJRrWm69g3q63',
        'redirect'=>'https://rentersland.com/login/google/callback'
    ],

];

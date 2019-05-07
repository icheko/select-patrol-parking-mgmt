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

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'select-patrol' => [
        'guest-pass-url' => env('SP_GUEST_PARKING_URL', 'https://www.selectpatrol.com/cabrillo-collection-hoa/'),
        'property-address' => env('SP_PROPERTY_ADDRESS', ''),
        'contact-first-name' => env('SP_CONTACT_FIRST_NAME', ''),
        'contact-last-name' => env('SP_CONTACT_LAST_NAME', ''),
        'contact-email' => env('SP_CONTACT_EMAIL', ''),
        'contact-phone' => env('SP_CONTACT_PHONE', ''),
        'person-vehicle-config' => env('SP_PERSON_VEHICLE_CONFIG', '{"firstname":{"person":{"first_name":"","last_name":"","email":""},"vehicle":{"licensePlate":"","make":"","model":"","color":""}}}'),
    ],

];

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
    'google' => [
        'client_id' => '46902090416-7o7mkdkss5mtpcnvuk34jjfghneqkr05.apps.googleusercontent.com',
        'client_secret' => 'uN_baWttWEMZP8hClsHis61j',
        'redirect' => 'http://localhost/blogbook/callback'
    ],
    'facebook' => [
        'client_id' => '683558612418611',
        'client_secret' => '06147a2940a8308cac5f614fed8d9feb',
        'redirect' => 'http://localhost/blogbook/callbackToFB'
    ],
    'twitter' => [
        'client_id' => 'H0CwXXzKrmBfBDf3r7hA6YrjG',
        'client_secret' => 'FA6JUTJCOm44LHz3cyBSuR846cj4vGxRb9kds9WzEUMWCHbtTP',
        'redirect' => 'http://localhost/blogbook/callbackToTwitter'
    ],

];

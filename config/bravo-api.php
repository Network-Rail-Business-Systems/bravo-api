<?php

return [
    'auth' => [
        'client_id' => env('BRAVO_API_USERNAME'),
        'client_secret' => env('BRAVO_API_PASSWORD'),
        'grant_type' => env('BRAVO_API_GRANT_TYPE', 'client_credentials '),
    ],

    // The base url for the bravo api, prepended to all api calls
    'base_url' => env('BRAVO_API_BASE_URL'),

    // Time in minutes to cache the token for
    'token_cache_for' => env('BRAVO_API_TOKEN_CACHE', 10),

    'proxy_address' => env('BRAVO_API_PROXY_ADDRESS', null),

    'timeout' => env('BRAVO_API_TIMEOUT', 10),
];

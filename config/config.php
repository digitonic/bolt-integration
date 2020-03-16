<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Botl Bearer Token
   |--------------------------------------------------------------------------
   |
   | This value is the bearer token for BOLT.  This is required to post
   | to the BOLT API.
   |
   */
    'bearer_token' => env('BOLT_BEARER_TOKEN', 'token_admin'),

    /*
   |--------------------------------------------------------------------------
   | Botl Webhook
   |--------------------------------------------------------------------------
   |
   | This value is the url for Bolt API.
   |
   */
    'api_endpoint' => env('BOLT_API_ENDPOINT', 'http://bolt.test:801/api/'),

];

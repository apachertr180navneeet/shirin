<?php

return [
    'merchant_key' => env('PAYU_MERCHANT_KEY'),
    'salt' => env('PAYU_SALT'),
    'base_url' => env('PAYU_BASE_URL', 'https://test.payu.in/_payment'),
];

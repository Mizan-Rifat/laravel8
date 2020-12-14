<?php

return [

    'currency' => 'BDT',
    'default_product_image'=>"images\/products\/default.svg",
    'currencies' => [
        'BDT' => [
            'name'                => 'Taka',
            'code'                => 50,
            'precision'           => 2,
            'subunit'             => 100,
            'symbol'              => '৳',
            'symbol_first'        => true,
            'decimal_mark'        => '.',
            'thousands_separator' => ',',
        ],
        'USD' => [
            'name'                => 'US Dollar',
            'code'                => 840,
            'precision'           => 2,
            'subunit'             => 100,
            'symbol'              => '$',
            'symbol_first'        => true,
            'decimal_mark'        => '.',
            'thousands_separator' => ',',
        ],
    ],


];

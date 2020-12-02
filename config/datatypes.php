<?php


return [
    'users'=>[
        'fields'=>[
            'label'=>''
        ],
    ],
    'roles'=>[
        'fields'=>[
            [
                'label'=>'Name',
                'type'=>'text'
            ],
            [
                'label'=>'Display Name',
                'type'=>'text'
            ],
            
        ],
    ],

    'products'=>[
        'fields'=>[
            [
                'label'=>'Name',
                'title'=>'name',
                'type'=>'text'
            ],
            [
                'label'=>'Category',
                'title'=>'category',
                'type'=>'select'
            ],
            [
                'label'=>'Image',
                'title'=>'image',
                'type'=>'image'
            ],
            [
                'label'=>'Description',
                'title'=>'description',
                'type'=>'text-area'
            ],
            [
                'label'=>'Price',
                'title'=>'price',
                'type'=>'text'
            ],
            [
                'label'=>'Active',
                'title'=>'active',
                'type'=>'switch'
            ],
        ]
    ]
];
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
    'ingredients'=>[
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text'
            ],
            
        ],
    ],
    'addable_items'=>[
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text'
            ],
            [
                'label'=>'Image',
                'column'=>'image',
                'field'=>'image',
                'edit_field'=>'image',
                'type'=>'image'
            ],
            [
                'label'=>'Price',
                'column'=>'price',
                'field'=>'formatted_price',
                'edit_field'=>'price',
                'type'=>'text'
            ],
            
        ],
    ],

    'products'=>[
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text'
            ],
            [
                'label'=>'Category',
                'column'=>'category_id',
                'field'=>'category',
                'edit_field'=>'categories',
                'type'=>'relationship-select',
                'relationship_field'=>'name',
                
            ],
            [
                'label'=>'Ingredients',
                'column'=>'ingredients',
                'field'=>'ingredients',
                'edit_field'=>'ingredients',
                'type'=>'relationship-multi-select',
                'relationship_field'=>'name',
                
            ],
            [
                'label'=>'Addable Items',
                'column'=>'addableItems',
                'field'=>'addableItems',
                'edit_field'=>'addableItems',
                'type'=>'relationship-multi-select',
                'relationship_field'=>'name',
                
            ],
            [
                'label'=>'Image',
                'column'=>'image',
                'field'=>'image',
                'edit_field'=>'image',
                'type'=>'image'
            ],
            [
                'label'=>'Description',
                'column'=>'description',
                'field'=>'description',
                'edit_field'=>'description',
                'type'=>'text-area'
            ],
            [
                'label'=>'Price',
                'column'=>'price',
                'field'=>'formatted_price',
                'edit_field'=>'price',
                'type'=>'text'
            ],
            [
                'label'=>'Active',
                'column'=>'active',
                'field'=>'active',
                'edit_field'=>'active',
                'type'=>'switch'
            ],
        ]
    ]
];
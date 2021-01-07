<?php

return [
    'users'=>[
        'nextBtn'=>false,
        'fields'=>[
            'label'=>''
        ],
    ],

    'categories'=>[
        'nextBtn'=>false,
        'fields'=>[
            [   
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ]
        ],
    ],

    'roles'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Display Name',
                'column'=>'display_name',
                'field'=>'display_name',
                'edit_field'=>'display_name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'permissions'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Title',
                'column'=>'title',
                'field'=>'title',
                'edit_field'=>'title',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Table Name',
                'column'=>'table_name',
                'field'=>'table_name',
                'edit_field'=>'table_name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'ingredients'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'players'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'nutritionalItems'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Title',
                'column'=>'title',
                'field'=>'title',
                'edit_field'=>'title',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'addableItems'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Image',
                'column'=>'image',
                'field'=>'image',
                'edit_field'=>'image',
                'type'=>'image',
                "indexShow"=>true,
            ],
            [
                'label'=>'Price',
                'column'=>'price',
                'field'=>'formatted_price',
                'edit_field'=>'price',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'products'=>[
        'nextBtn'=>true,
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Category',
                'column'=>'category_id',
                'field'=>'category',
                'edit_field'=>'categories',
                'type'=>'relationship-select',
                'relationship_field'=>'name',
                "indexShow"=>true,
                
            ],
            [
                'label'=>'Ingredients',
                'column'=>'ingredients',
                'field'=>'ingredients',
                'edit_field'=>'ingredients',
                'type'=>'relationship-multi-select',
                'relationship_field'=>'name',
                "indexShow"=>true,
                
            ],
            [
                'label'=>'Addable Items',
                'column'=>'addableItems',
                'field'=>'addableItems',
                'edit_field'=>'addableItems',
                'type'=>'relationship-multi-select',
                'relationship_field'=>'name',
                "indexShow"=>true,
                
            ],
            [
                'label'=>'Nutritional Values',
                'column'=>'addableItems',
                'field'=>'nutritionalValues',
                'edit_field'=>'addableItems',
                'type'=>'multi-select-pivot',
                "indexShow"=>false,
                
            ],
            [
                'label'=>'Image',
                'column'=>'image',
                'field'=>'image',
                'edit_field'=>'image',
                'type'=>'image',
                "indexShow"=>true,
            ],
            [
                'label'=>'Description',
                'column'=>'description',
                'field'=>'description',
                'edit_field'=>'description',
                'type'=>'text-area',
                "indexShow"=>true,
            ],
            [
                'label'=>'Price',
                'column'=>'price',
                'field'=>'formatted_price',
                'edit_field'=>'price',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Active',
                'column'=>'active',
                'field'=>'active',
                'edit_field'=>'active',
                'type'=>'switch',
                "indexShow"=>true,
            ],
            
        ]
    ],

];
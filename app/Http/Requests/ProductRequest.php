<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ProductRequest extends FormRequest
{

    private $storeRules = [
        'name' => ['required','string'],
        'category_id' => ['required','integer','exists:categories,id'],
        'ingredients' => ['array'],
        'ingredients.*' => ['numeric','exists:ingredients,id'],
        'addableItems' => ['array'],
        'addableItems.*' => ['numeric','exists:addable_items,id'],
        'description'=>['nullable'],
        'price'=>['required','regex:/^\d+(\.\d{1,2})?$/'],
        'images' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    private $updateRules = [
        'name' => ['string'],
        'category_id' => ['integer','exists:categories,id'],
        'ingredients' => ['array'],
        'ingredients.*' => ['numeric','exists:ingredients,id'],
        'addableItems' => ['array'],
        'addableItems.*' => ['numeric','exists:addable_items,id'],
        'description'=>['nullable'],
        'price'=>['regex:/^\d+(\.\d{1,4})?$/'],
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return Route::currentRouteName() == 'product.store' ? $this->storeRules : $this->updateRules;
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
        ];
    }
}

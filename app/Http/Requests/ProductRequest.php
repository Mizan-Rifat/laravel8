<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ProductRequest extends FormRequest
{

    private $storeRules = [
        'name' => ['required','string'],
        'category' => ['required','integer','exists:categories,id'],
        'description'=>['nullable'],
        'price'=>['required','regex:/^\d+(\.\d{1,2})?$/'],
        'active'=>['required'],
        'images' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    private $updateRules = [
        'name' => ['string'],
        'category' => ['integer','exists:categories,id'],
        'description'=>['nullable'],
        'price'=>['regex:/^\d+(\.\d{1,2})?$/'],
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
}

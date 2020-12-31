<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class IngredientRequest extends FormRequest
{

    private $storeRules = [
        'name' => ['required','string']
    ];

    private $updateRules = [
        'name' => ['string']
    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return Route::currentRouteName() == 'ingredients.store' ? $this->storeRules : $this->updateRules;
    }

    public function messages()
    {

    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class NutritionalItemRequest extends FormRequest
{

    private $storeRules = [];

    private $updateRules = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return Route::currentRouteName() == 'nutritionalItems.store' ? $this->storeRules : $this->updateRules;
    }

    public function messages()
    {

    }
}

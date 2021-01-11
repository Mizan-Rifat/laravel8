<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $storeRules = [
            'name'=>['required','string'],
            'email'=>['required','email','unique:users,email'],
            'avatar'=>['nullable','string']
        ];

        $updateRules = [
            'name' => ['max:20','min:5','regex:/^[a-zA-Z ]+$/'],
            'email' => ['email','unique:users,email,'.$this->user->id],
            'blocked' => ['boolean'],
            'old_password' => [
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'password' => ['string','min:8', 'confirmed'],
        ];
       return Route::currentRouteName() == 'users.store' ? $storeRules : $updateRules;
    }


    
}

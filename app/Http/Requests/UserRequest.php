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
            // 'name'=>['string'],
            // 'email' => ['email','unique:users,email,'.$this->user->id],
            // 'avatar'=>['nullable','string'],
            // 'password'=>['nullable','string'],

            'name' => ['max:20','min:2','regex:/^[a-zA-Z ]+$/'],
            'email' => ['email','unique:users,email,'.$this->user->id],
            'blocked' => ['boolean'],
            'old_password' => [
                'nullable', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'password' => ['nullable','min:8'],
            'fbID'=>['nullable','unique:users,fbID,'.$this->user->id]
        ];
       return Route::currentRouteName() == 'users.store' ? $storeRules : $updateRules;
    }

    
}

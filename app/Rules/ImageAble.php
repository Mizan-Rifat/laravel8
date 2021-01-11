<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\ImageManagerStatic;

class ImageAble implements Rule
{
    public function __construct()
    {
        //
    }
    public function passes($attribute, $value)
    { 
        $res= mime_content_type($value);
        if ($res == 'image/png' || $res == 'image/jpeg') {
            return true;
        }else{
            return false;
        }
       
    }


    public function message()
    {
        return 'The validation error message.';
    }
}

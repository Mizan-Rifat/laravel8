<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class ProfileController extends Controller
{
    public function show(){
        $user = Auth::user();

        $user->load('roles');

        return view('admin.profile.profile')->with([
            'user'=>$user,
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();

    }

    public function updateAvatar(Request $request,User $user){

        $validator = Validator::make($request->all(), [
            'avatar' => [
                function ($attribute, $value, $fail) {

                    try {
                        if (mime_content_type($value) === 'image/png') {
                            return true;
                        }
                    } catch (\Throwable $th) {
                        $fail('The '.$attribute.' is invalid.');
                    }
                },
            ],
        ])->validate();

        
        $image = $request->avatar; 
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';

        if($user->avatar != null){
            Storage::delete($user->avatar);
        }

        Storage::put('/avatars/'.$imageName, base64_decode($image));

        $user->avatar = '/avatars/'.$imageName;
        $user->save();


        return redirect()->back()->with('message', 'Updated Successfully!');

    }

    public function changePassword(){
    }

    public function removeImage(){
        
    }
}

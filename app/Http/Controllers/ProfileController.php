<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function removeImage(){
        
    }
}

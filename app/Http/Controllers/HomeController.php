<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function product(){
<<<<<<< HEAD
=======
        $actions = collect(['browse','create','read','update','delete']);
        $tables = collect(['users','permissions','roles']);


        $data = $tables->crossJoin($actions);

      return  $data->map(function($item){
            return [
                'title'=>$item[1].'_'.$item[0],
                'table_name'=>$item[0],
            ];
        });


>>>>>>> role
        return view('admin.product');
    }
}

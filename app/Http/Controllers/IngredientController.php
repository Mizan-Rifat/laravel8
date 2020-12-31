<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        $dataType = 'ingredient';
        $data = Ingredient::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        $ingredient = Ingredient::create($request->all());

        return redirect()->route('ingredients.index')->with('message', 'Created Successfully!');
    }

    public function show(Ingredient $ingredient)
    {
        $dataType = 'ingredient';
        $data = $ingredient;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(Ingredient $ingredient)
    {
        $dataType = 'ingredient';
        $data = $ingredient;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        $dataType = 'ingredient';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->id);

        $ingredient->update($request->all());

        return redirect()->route('ingredients.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Ingredient::destroy($request->ids);
        return redirect()->route('ingredients.index')->with('message', 'Deleted Successfully!');
    }
}
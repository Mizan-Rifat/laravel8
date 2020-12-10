<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();

        return view('admin.ingredients.index')->with('ingredients',$ingredients);
    }

    public function store(Request $request)
    {
        $ingredient = Ingredient::create($request->all());

        return redirect()->route('ingredient.index')->with('message', 'Created Successfully!');
    }

    public function show(Ingredient $ingredient)
    {
        return view('admin.ingredients.show')->with('ingredient',$ingredient);
    }
    
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.add-edit')->with('ingredient',$ingredient);
    }

    public function create()
    {
        return view('admin.ingredients.add-edit');
    }

    public function update(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->id);

        $ingredient->update($request->all());

        return redirect()->route('ingredient.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredient.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Ingredient::destroy($request->ids);
        return redirect()->route('ingredient.index')->with('message', 'Deleted Successfully!');
    }
}
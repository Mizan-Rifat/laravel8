<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index')->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('category.index')->with('message', 'Created Successfully!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show')->with('category',$category);
    }
    
    public function edit(Category $category)
    {
        return view('admin.categories.add-edit')->with('category',$category);
    }

    public function create()
    {
        return view('admin.categories.add-edit');
    }

    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);

        $category->update($request->all());

        return redirect()->route('category.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Category::destroy($request->ids);
        return redirect()->route('category.index')->with('message', 'Deleted Successfully!');
    }
}
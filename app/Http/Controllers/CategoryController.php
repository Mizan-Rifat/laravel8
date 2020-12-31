<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $dataType = 'category';
        $data = Category::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('categories.index')->with('message', 'Created Successfully!');
    }

    public function show(Category $category)
    {
        $dataType = 'category';
        $data = $category;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));
    }
    
    public function edit(Category $category)
    {
        $dataType = 'category';
        $data = $category;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        $dataType = 'category';
        $data = null;
        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Category::destroy($request->ids);
        return redirect()->route('categories.index')->with('message', 'Deleted Successfully!');
    }
}
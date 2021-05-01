<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('browse_categories');
        $dataType = 'category';
        $data = Category::all();

        return $data;

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        Gate::authorize('create_categories');
        $category = Category::create($request->all());

        return redirect()->route('categories.index')->with('message', 'Created Successfully!');
    }

    public function show(Category $category)
    {
        Gate::authorize('read_categories');
        $dataType = 'category';
        $data = $category;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));
    }
    
    public function edit(Category $category)
    {
        Gate::authorize('update_categories');
        $dataType = 'category';
        $data = $category;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        Gate::authorize('create_categories');
        $dataType = 'category';
        $data = null;
        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request,Category $category)
    {
        Gate::authorize('update_categories');

        $category->update($request->all());

        return redirect()->route('categories.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        Gate::authorize('delete_categories');
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){
        Gate::authorize('delete_categories');

        Category::destroy($request->ids);
        return redirect()->route('categories.index')->with('message', 'Deleted Successfully!');
    }
}
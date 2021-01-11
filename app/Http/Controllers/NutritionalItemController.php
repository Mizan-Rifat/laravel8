<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionalItemRequest;
use Illuminate\Http\Request;
use App\Models\NutritionalItem;
use Illuminate\Support\Facades\Gate;

class NutritionalItemController extends Controller
{
    public function index()
    {
        Gate::authorize('browse_nutritional_items');
        $dataType = 'nutritionalItem';
        $data = NutritionalItem::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        Gate::authorize('create_nutritional_items');
        $nutritionalItem = NutritionalItem::create($request->all());

        return redirect()->route('nutritionalitems.index')->with('message', 'Created Successfully!');
    }

    public function show(NutritionalItem $nutritionalItem)
    {
        Gate::authorize('show_nutritional_items');
        $dataType = 'nutritionalItem';
        $data = $nutritionalItem;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(NutritionalItem $nutritionalItem)
    {
        Gate::authorize('update_nutritional_items');
        $dataType = 'nutritionalItem';
        $data = $nutritionalItem;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        Gate::authorize('create_nutritional_items');
        $dataType = 'nutritionalItem';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request,NutritionalItem $nutritionalItem)
    {

        Gate::authorize('update_nutritional_items');

        $nutritionalItem->update($request->all());

        return redirect()->route('nutritionalitems.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(NutritionalItem $nutritionalItem)
    {
        Gate::authorize('delete_nutritional_items');
        $nutritionalItem->delete();

        return redirect()->route('nutritionalitems.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){
        Gate::authorize('delete_nutritional_items');
        NutritionalItem::destroy($request->ids);
        return redirect()->route('nutritionalitems.index')->with('message', 'Deleted Successfully!');
    }
}
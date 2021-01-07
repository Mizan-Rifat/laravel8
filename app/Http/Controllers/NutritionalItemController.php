<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionalItemRequest;
use Illuminate\Http\Request;
use App\Models\NutritionalItem;

class NutritionalItemController extends Controller
{
    public function index()
    {
        $dataType = 'nutritionalItem';
        $data = NutritionalItem::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        $nutritionalItem = NutritionalItem::create($request->all());

        return redirect()->route('nutritionalitems.index')->with('message', 'Created Successfully!');
    }

    public function show(NutritionalItem $nutritionalItem)
    {
        $dataType = 'nutritionalItem';
        $data = $nutritionalItem;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(NutritionalItem $nutritionalItem)
    {
        $dataType = 'nutritionalItem';
        $data = $nutritionalItem;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        $dataType = 'nutritionalItem';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request,NutritionalItem $nutritionalItem)
    {

        $nutritionalItem->update($request->all());

        return redirect()->route('nutritionalitems.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(NutritionalItem $nutritionalItem)
    {
        $nutritionalItem->delete();

        return redirect()->route('nutritionalitems.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        NutritionalItem::destroy($request->ids);
        return redirect()->route('nutritionalitems.index')->with('message', 'Deleted Successfully!');
    }
}
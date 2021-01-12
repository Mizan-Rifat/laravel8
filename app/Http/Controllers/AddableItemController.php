<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddableItem;
use Illuminate\Support\Facades\Gate;

class AddableItemController extends Controller
{
    public function index()
    {
        Gate::authorize(get_gate_action('AddableItem','browse'));

        $dataType = 'addableItem';
        $data = AddableItem::all();
        
        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        Gate::authorize(get_gate_action('AddableItem','create'));


        $images = [];
        if($files=$request->file('images')){
            foreach($files as $file){
                $file->store('addAbleItems');
                array_push($images,"images/addAbleItems/".$file->hashName());
            }
        }

        $addableitem = AddableItem::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>json_encode($images),
        ]);

        return redirect()->route('addableitems.index')->with('message', 'Created Successfully!');
    }

    public function show(AddableItem $addableItem)
    {
        Gate::authorize(get_gate_action('AddableItem','read'));

        $dataType = 'addableItem';
        $data = $addableItem;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

        // return view('admin.bread.show')->with('addableitem',$addableitem);
    }
    
    public function edit(AddableItem $addableItem)
    {
        Gate::authorize(get_gate_action('AddableItem','update'));

        $dataType = 'addableItem';
        $data = $addableItem;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        Gate::authorize(get_gate_action('AddableItem','create'));

        $dataType = 'addableItem';
        $data = null;
        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
        
    }

    public function update(Request $request,AddableItem $addableitem)
    {
        Gate::authorize(get_gate_action('AddableItem','update'));


        $addableitemImages = $addableitem->image == null ? [] : json_decode($addableitem->image);

        if($files=$request->file('images')){
            foreach($files as $file){
                $file->store('addAbleItems');
                array_push($addableitemImages,"images/addAbleItems/".$file->hashName());
            }
        }

        $addableitem->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>json_encode($addableitemImages),
        ]);


        return redirect()->route('addableitems.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(AddableItem $addableItem)
    {
        Gate::authorize(get_gate_action('AddableItem','delete'));

        $addableItem->delete();

        return redirect()->route('addableitem.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('AddableItem','delete'));

        AddableItem::destroy($request->ids);
        return redirect()->route('addableitems.index')->with('message', 'Deleted Successfully!');
    }

    public function removeImage(){
        
    }
}
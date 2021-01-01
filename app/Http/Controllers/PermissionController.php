<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $dataType = 'permission';
        $data = Permission::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());

        return redirect()->route('permissions.index')->with('message', 'Created Successfully!');
    }

    public function show(Permission $permission)
    {

        $dataType = 'permission';
        $data = $permission;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(Permission $permission)
    {
        $dataType = 'permission';
        $data = $permission;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        $dataType = 'permission';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request)
    {
        $permission = Permission::findOrFail($request->id);

        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Permission::destroy($request->ids);
        return redirect()->route('permissions.index')->with('message', 'Deleted Successfully!');
    }
}
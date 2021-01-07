<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(){

        $dataType = 'role';
        $data = Role::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));

    }


    public function show(Role $role){
       
        $role->load('permissions');
        $allPermissions = Permission::all()->groupBy('table_name');

        $dataType = 'role';
        $data = $role;

        return view('admin.bread.show',compact(
            'data',
            'dataType',
            'allPermissions'
        ));
        
    }

    public function edit(Role $role){

        $role->load('permissions');
        $allPermissions = Permission::all()->groupBy('table_name');

        $dataType = 'role';
        $data = $role;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType',
            'allPermissions'
        ));
    }

    public function update(Request $request,Role $role){

        $validatedData = $request->validate([
            'display_name' => ['string'],
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role->id),
            ],
        ]);

        $role->update($validatedData);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('message', 'Updated Successfully!');

    }


    public function create(){
        $dataType = 'role';
        $data = null;
        $allPermissions = Permission::all()->groupBy('table_name');

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType',
            'allPermissions'
        ));
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'display_name' => ['string'],
            'name' => [
                'required',
                'unique:roles,name'
            ],
        ]);

        $permissions = $request->validate([
            'permissions'=>'array'
        ]);



        $role = Role::create($validatedData);

        $role->permissions()->attach($request->permissions);

        
        return redirect()->route('roles.index')->with('message', 'Created Successfully!');

    }

    public function destroy(Role $role){

        $role->permissions()->sync([]);
        $role->delete();
        return redirect()->route('roles.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        collect($request->ids)->map(function($item){
            Role::find($item)->permissions()->sync([]);
        });
        Role::destroy($request->ids);
        return redirect()->route('roles.index')->with('message', 'Deleted Successfully!');
    }
}

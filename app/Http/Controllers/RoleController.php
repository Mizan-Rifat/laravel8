<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(){

        $roles = Role::all();

        // return $roles;
        return view('admin.roles.index')->with('roles',$roles);
    }


    public function show(Role $role){
        
        return view('admin.roles.show')->with('role',$role);
    }

    public function edit(Role $role){

        $role->load('permissions');
        $allPermissions = Permission::all()->groupBy('table_name');

        return view('admin.roles.add-edit',compact(
            'role',
            'allPermissions'
        ));
    }

    public function update(Request $request){



        $role = Role::findOrFail($request->id);
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
        
        $allPermissions = Permission::all()->groupBy('table_name');
        return view('admin.roles.add-edit',compact(
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

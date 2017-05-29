<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index',compact('roles'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $permissions = Permission::all();
            return view('admin.role.create_edit',compact('permissions'));
        }
        $role = Role::firstOrCreate(['name' => $request->get('name')]);
        if (count($request->get('permissions'))) {
            $permissions = Permission::whereIn('id',$request->get('permissions'))->get();
            $role->givePermissionTo($permissions);
        }
        return toastr(['path' => '/admin/role']);
    }

    public function edit(Request $request,$id)
    {
        $role = Role::find($id);
        if ($request->isMethod('get')) {
            $permissions = Permission::all();
            return view('admin.role.create_edit', compact('role','permissions'));
        }
        Role::updateOrCreate(['id' => $id], ['name' => $request->get('name')]);
        if (count($request->get('permissions'))) {
            $role->revokePermissionTo($role->permissions);
            $permissions = Permission::whereIn('id',$request->get('permissions'))->get();
            $role->givePermissionTo($permissions);
        }
        return toastr(['path' => '/admin/role']);
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return toastr();
    }
}

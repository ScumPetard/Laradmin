<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.permissions.create_edit');
        }
        Permission::firstOrCreate(['name' => $request->get('name')]);
        return toastr(['path' => '/admin/permission']);
    }


    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $permission = Permission::find($id);
            return view('admin.permissions.create_edit', compact('permission'));
        }
        Permission::updateOrCreate(['id' => $id], ['name' => $request->get('name')]);
        return toastr(['path' => '/admin/permission']);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (count($permission->roles)) {
            foreach ($permission->roles as $role) {
                $role->revokePermissionTo($permission);
            }
        }
        Permission::destroy($id);
        return toastr();
    }
}

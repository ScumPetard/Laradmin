<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $roles = Role::all();
            return view('admin.user.create_edit',compact('roles'));
        }
        $user = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar_url = uploadImage($request->file('avatar'),'user/avatar');
            if ($avatar_url) {
                $user['avatar'] = $avatar_url;
            } else {
                throw new \Exception('头像上传失败');
            }
        } else {
            $user['avatar'] = '/resource/admin/images/avatar.jpg';
        }
        try {
            $user = User::create($user);
            if ($user) {
                if (count($request->get('roles'))) {
                    $roles = Role::whereIn('id',$request->get('roles'))->get();
                    $user->assignRole($roles);
                }
                return toastr(['path' => '/admin/user']);
            }
            throw new \Exception('创建失败');
        } catch (\Exception $exception){
            return toastr(['message' => $exception->getMessage(),'type' => 'error']);
        }
    }

    public function edit(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $user = User::find($id);
            if ($user) {
                $roles = Role::all();
                return view('admin.user.create_edit',compact('user','roles'));
            }
            throw new \Exception('不存在的用户');
        }
        $user = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar_url = uploadImage($request->file('avatar'),'user/avatar');
            if ($avatar_url) {
                $user['avatar'] = $avatar_url;
            } else {
                throw new \Exception('头像上传失败');
            }
        }
        if ($request->get('password')) {
            $user['password'] = bcrypt($request->get('password'));
        }
        try {
            $user = User::updateOrCreate(['id' => $id],$user);
            if ($user) {
                $user->removeRole($user->roles);
                if (count($request->get('roles'))) {
                    $roles = Role::whereIn('id',$request->get('roles'))->get();
                    $user->assignRole($roles);
                }
                return toastr(['path' => '/admin/user']);
            }
            throw new \Exception('修改失败');
        } catch (\Exception $exception){
            return toastr(['message' => $exception->getMessage(),'type' => 'error']);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $user->removeRole($user->roles);
            $user->delete();
        }
        return toastr();
    }
}

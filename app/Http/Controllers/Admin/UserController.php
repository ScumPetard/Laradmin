<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $roles = Role::all();
            return view('admin.user.create_edit', compact('roles'));
        }
        $user = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar_url = uploadImage($request->file('avatar'), 'user/avatar', ['width' => 150]);
            if ($avatar_url) {
                $user['avatar'] = $avatar_url;
            } else {
                throw new \Exception('头像上传失败');
            }
        } else {
            $user['avatar'] = '/avatar.jpg';
        }
        try {
            $user = User::create($user);
            if ($user) {
                if (count($request->get('roles'))) {
                    $roles = Role::whereIn('id', $request->get('roles'))->get();
                    $user->assignRole($roles);
                }
                return toastr(['path' => '/admin/user']);
            }
            throw new \Exception('创建失败');
        } catch (\Exception $exception) {
            return toastr(['message' => $exception->getMessage(), 'type' => 'error']);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $user = User::find($id);
            if ($user) {
                $roles = Role::all();
                return view('admin.user.create_edit', compact('user', 'roles'));
            }
            throw new \Exception('不存在的用户');
        }
        $user = $request->all();
        if (
            $request->hasFile('avatar')
        ) {
            $avatar_url = uploadImage(
                $request->file('avatar'),
                'user/avatar',
                ['width' => 150]
            );
            if (!$avatar_url) {
                throw new \Exception('头像上传失败');

            }
            $user['avatar'] = $avatar_url;

        }
        if ($request->get('password')) {
            $user['password'] = bcrypt($request->get('password'));
        }
        try {
            $user = User::updateOrCreate(['id' => $id], $user);
            if ($user) {
                $user->removeRole($user->roles);
                if (count($request->get('roles'))) {
                    $roles = Role::whereIn('id', $request->get('roles'))->get();
                    $user->assignRole($roles);
                }
                return toastr(['path' => '/admin/user']);
            }
            throw new \Exception('修改失败');
        } catch (\Exception $exception) {
            return toastr(['message' => $exception->getMessage(), 'type' => 'error']);
        }
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->removeRole($user->roles);
            $user->delete();
        }
        return toastr();
    }
}

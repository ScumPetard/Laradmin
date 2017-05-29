<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignController extends Controller
{
    public function sign(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.sign.sign');
        }
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'enable' => 1
        ])) {
            return toastr(['message' => 'Welcome Back','path' => '/admin/index']);
        }
        return toastr(['message' => '登录失败','type' => 'error']);
    }

    public function signOut()
    {
        Auth::logout();
        return toastr(['message' => '退出成功','path' => '/admin']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm(){

        dd(1);exit;
        if (Auth::check()) {
            return redirect('admin');
        } else {
            return view('admin/login');
        }
    }
    public function login(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $data = $request->all();;
        $attempt = [
            'account'  => $data['username'],
            'password' => $data['password'],
            'status'   => 1,      //如果禁用，无法登录
        ];
        if (Auth::guard('admin')->attempt($attempt)) {
            return redirect('admin');
        } else {
//          return 46545465;
            return redirect('admin/login')->with('error', '用户名或密码错误或账号禁用');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}

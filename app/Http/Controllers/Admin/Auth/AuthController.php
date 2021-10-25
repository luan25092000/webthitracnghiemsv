<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Requests\LoginAdminRequest;

class AuthController extends Controller
{
    public function showLogin() {
        return view('admin.auth.login');
    }

    public function handleLogin(LoginAdminRequest $request) {
        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $admin = Admin::where([['email','=',$request->input('email')]])->first();
            Auth::guard('admin')->login($admin);
            return redirect()->route('dashboard.index')->with("success", "Đăng nhập thành công");
        }
        else{
            return redirect()->back()->with("invalid","Email/Mật khẩu không đúng, vui lòng đăng nhập lại");
        }
    }

    public function handleLogout() {
        Auth::guard('admin')->logout();
        return redirect()->route('auth.show.login')->with('success','Đăng xuất thành công');
    }
}

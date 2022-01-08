<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() {
        return view('page.auth.login');
    }

    public function handleLogin(Request $request) {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = User::where([['email','=',$request->input('email')]])->first();
            Auth::login($user);
            return redirect()->route('page.index')->with("success", "Đăng nhập thành công");
        }
        else{
            return redirect()->back()->with("invalid","Email/Mật khẩu không đúng, vui lòng đăng nhập lại");
        }
    }

    public function handleLogout() {
        Auth::logout();
        return redirect()->route('page.show.login')->with('success','Đăng xuất thành công');
    }
}

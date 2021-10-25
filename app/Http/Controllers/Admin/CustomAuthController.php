<?php

namespace App\Http\Controllers\backend;

use App\Exports\PostExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CustomAuthController extends Controller
{ 
    public function index(){     
        if(Auth::guard('admin')->check())       {
            return view('admin.dashboard');
        }
        return redirect()->route('admin.login');
    }

    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('backend.auth.login');
        }

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ],[
        //     'email.required' => 'Vui lòng điền email',
        //     'email.email' => 'Email sai định dạng',
        //     'password.required' => 'Vui lòng điền mật khẩu'
        // ]);
        
       
        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials,$request->has('remember-me'))) {             
            return view('admin.dashboard');
        } else {
            return redirect()->back()->withInput();
        }    
          
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function resetPass(Request $request){
        if ($request->getMethod() == 'GET') {
            return view('admin.auth.reset');
        }
        // $request->validate([
        //     'email' => 'required|email|exists:users',
            
        // ],[
        //     'email.required' => 'Vui lòng điền email',
        //     'email.email' => 'Email sai định dạng',
        //     'email.exists' => 'Email không tồn tại'
        // ]);

        $token =  Str::random(64);
        $data = ['email' => $request->email, 'token' => $token];
        Mail::send('admin.auth.mail_send', ['data' => $data], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function register(Request $request){
        if ($request->getMethod() == 'GET') {
            return view('admin.auth.register');
        }
        // $request->validate([
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required',
        // ],[
        //     'email.required' => 'Vui lòng điền email',
        //     'email.email' => 'Email sai định dạng',
        //     'email.unique' => 'Email đã tồn tại',
        //     'password.required' => 'Vui lòng điền mật khẩu'
        // ]
        // );

        $model = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);
        return view('admin.auth.login');
    }
    public function recoveryPass(Request $request){
        if ($request->getMethod() == 'GET') {
            $data =  ['email' => $request->data['email'],'token' => $request->data['email']];       
            return view('admin.auth.recovery_pass',['data'=>$data]);
        }
    
        Admin::where('email', $request->email)
        ->update([
            'remember_token' => $request->token,
            'password' => bcrypt($request->password),               
        ]);
        return view('admin.auth.login');
    }

    public function exportFile(Request $request){
        
        if($request->model=="user"){
            return Excel::download(new UserExport, 'user.xlsx');
        }
        else{
            return  Excel::download(new PostExport, 'post.xlsx');
        }
        
        
    }

    public function export(){
            $user = User::all();
            return view('admin.auth.export',['user' => $user]);        
    }

    public function import(Request $request) 
    {
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return back();
    }

    public function rule(Request $request){
        if ($request->getMethod() == 'GET') {
           return view('admin.role.create');
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
        ]);
        return redirect()->route('admin.rule')->with('success','Thêm mới thành công');
    }
}

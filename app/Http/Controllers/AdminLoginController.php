<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function index()
    {
        $PageTitle = 'Admin Login';
        return view('Admin.Auth.login',compact('PageTitle'));
    }

     public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if(Auth::guard('admin')->attempt($request->only('email','password'), $request->filled('remember'))){
            return redirect()->route('admin.home')->with('success','Successfully Logged-In');
        }

        return back()->withErrors(['email' => 'invalid Credentials']);
    }

      public function register_view()
    {
        $PageTitle = 'Admin Registration';
        return view('Admin.Auth.register',compact('PageTitle'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required'
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success','Successfully Registered');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','Successfully logout!');
    }
}

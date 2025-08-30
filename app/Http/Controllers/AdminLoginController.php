<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','Successfully logout!');
    }
}

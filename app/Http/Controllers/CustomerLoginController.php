<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
         public function index()
    {
        $PageTitle = 'Customer Login';
        return view('Customer.Auth.login',compact('PageTitle'));
    } 

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if(Auth::guard('customer')->attempt($request->only('email','password'), $request->filled('remember'))){
            return redirect()->route('customer.home')->with('success','Successfully Logged-In');
        }

        return back()->withErrors(['email' => 'invalid Credentials']);
    }
    
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login')->with('success','Successfully logout!');
    }
}

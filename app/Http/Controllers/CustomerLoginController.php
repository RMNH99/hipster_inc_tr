<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\PresenceService;
use App\Model\Customers;

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

            $customer = Auth::guard('customer')->user();

            PresenceService::updatePresence($customer, true);

            return redirect()->route('customer.home')->with('success','Successfully Logged-In');
        }

        return back()->withErrors(['email' => 'invalid Credentials']);
    }

    public function register_view()
    {
        $PageTitle = 'Customer Registration';
        return view('Customer.Auth.register',compact('PageTitle'));
    } 

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,email',
            'password' => 'required'
        ]);


        $admin = new Customer;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success','Successfully Registered');
    }
    
    public function logout()
    {
        $customer = Auth::guard('customer')->user();

    if($customer) {
        
        PresenceService::updatePresence($customer, false);
    }

    Auth::guard('customer')->logout();
        return redirect()->route('customer.login')->with('success','Successfully logout!');
    }
}

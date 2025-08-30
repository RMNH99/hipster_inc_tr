<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $PageTitle = 'Customer Dashboard';
        return view('Customer.pages.dashboard',compact('PageTitle'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $PageTitle = 'Admin Dashboard';
        return view('Admin.pages.dashboard',compact('PageTitle'));
    }
}

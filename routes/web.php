<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CustomerLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function()
{
    Route::middleware('guest:admin')->group(function()
    {
        Route::get('/login',[AdminLoginController::class,'index'])->name('login');
        Route::post('/login-auth',[AdminLoginController::class,'login'])->name('login.auth');
    });

    Route::middleware('auth:admin')->group(function()
    {
        Route::get('/dashboard',[AdminController::class,'index'])->name('home');
        Route::any('/logout',[AdminLoginController::class,'logout'])->name('logout');
       
    });
});

Route::prefix('customer')->name('customer.')->group(function()
{
    Route::middleware('guest:customer')->group(function()
    {
        Route::get('/login',[CustomerLoginController::class,'index'])->name('login');
        Route::post('/login-auth',[CustomerLoginController::class,'login'])->name('login.auth');
    });

    Route::middleware('auth:customer')->group(function()
    {
        Route::get('/dashboard',[CustomerController::class,'index'])->name('home');
        Route::any('/logout',[CustomerLoginController::class,'logout'])->name('logout');
       
    });
});
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

        Route::get('/register',[AdminLoginController::class,'register_view'])->name('register');
        Route::post('/register-auth',[AdminLoginController::class,'register'])->name('register.auth');
    });

    Route::middleware('auth:admin')->group(function()
    {
        Route::get('/dashboard',[AdminController::class,'index'])->name('home');
        Route::get('/products',[AdminController::class,'products'])->name('products');

        Route::get('/add_product',[AdminController::class,'add_product'])->name('add_product');
        Route::post('/store_product',[AdminController::class,'store_product'])->name('store_product');

        Route::get('/import_product',[AdminController::class,'import_product'])->name('import_product');
        Route::post('/store_imported_product',[AdminController::class,'store_imported_product'])->name('store_imported_product');

        Route::get('/edit_product/{id}',[AdminController::class,'edit_product'])->name('edit_product');
        Route::post('/update_product',[AdminController::class,'update_product'])->name('update_product');
        Route::post('/delete_product',[AdminController::class,'delete_product'])->name('delete_product');
        
        Route::get('/orders',[AdminController::class,'orders'])->name('orders');
        Route::get('/complete_orders',[AdminController::class,'complete_orders'])->name('complete_orders');

        Route::post('/update-status/{order}/', [AdminController::class, 'updateStatus'])->name('updateStatus');

        Route::any('/logout',[AdminLoginController::class,'logout'])->name('logout');
       
    });
});

Route::prefix('customer')->name('customer.')->group(function()
{
    Route::middleware('guest:customer')->group(function()
    {
        Route::get('/login',[CustomerLoginController::class,'index'])->name('login');
        Route::post('/login-auth',[CustomerLoginController::class,'login'])->name('login.auth');

        Route::get('/register',[CustomerLoginController::class,'register_view'])->name('register');
        Route::post('/register-auth',[CustomerLoginController::class,'register'])->name('register.auth');
    });

    Route::middleware('auth:customer')->group(function()
    {
        Route::get('/dashboard',[CustomerController::class,'index'])->name('home');

        Route::get('/search-product',[CustomerController::class,'search_product'])->name('search');
        Route::get('/products',[CustomerController::class,'products'])->name('products');

        Route::any('/logout',[CustomerLoginController::class,'logout'])->name('logout');

        Route::get('/cart', [CustomerController::class, 'cart'])->name('cart');
        Route::post('/cart-add/{pId}', [CustomerController::class, 'add_to_cart'])->name('cart_add');
        Route::post('/cart-remove/{pId}', [CustomerController::class, 'remove_to_cart'])->name('cart_remove');
        Route::post('/place-order', [CustomerController::class, 'place_order'])->name('place_order');
        Route::get('/cart-count', [CustomerController::class, 'cart_count'])->name('cart_count');

        Route::get('/order/{id}', [CustomerController::class, 'order'])->name('order');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
       
    });
});
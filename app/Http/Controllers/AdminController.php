<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Jobs\ProductImportJob;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $PageTitle = 'Admin Dashboard';
        return view('Admin.pages.dashboard',compact('PageTitle'));
    }

    public function products()
    {
        $PageTitle = 'Products';
        $products = Product::paginate(10);
        return view('admin.pages.products',compact('PageTitle','products'));
    }
    
    public function orders()
    {
        $PageTitle = 'Orders';
        return view('admin.pages.orders',compact('PageTitle'));
    }
    public function complete_orders()
    {
        $PageTitle = 'Complted Orders';
        return view('admin.pages.orders',compact('PageTitle'));
    }

    public function add_product()
    {
        $PageTitle = 'Add Product';
        return view('admin.pages.add_product',compact('PageTitle'));
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'prodImg' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $img = 'products/default_image.png';
        if($request->hasFile('prodImg'))
        {
            $img = $request->file('prodImg')->store('products','public');
        }
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = $img;
        $product->save();

        return back()->with('success','Successfully added!');
    }

    public function edit_product($id)
    {
        $product = Product::findOrFail($id);
        $PageTitle = 'Edit Product';
        return view('admin.pages.edit_product',compact('PageTitle','product'));
    }
    
    public function update_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $product = Product::findOrFail($request->id);
        $img = $product->image;
        
        if($request->hasFile('prodImg'))
        {
            $img = $request->file('prodImg')->store('products','public');
        }
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = $img;
        $product->save();
        return back()->with('success','Successfully Updated!');
    }

    public function delete_product(Request $request)
    {
        Product::findOrFail($request->delId)->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }

    public function import_product()
    {
       $PageTitle = 'Import Product';
        return view('admin.pages.import_csv',compact('PageTitle')); 
    }

    public function store_imported_product(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv'
        ]);

        $filepath = $request->file('file')->getRealPath();
        $rows = array_map('str_getcsv', file($filepath));

        ProductImportJob::dispatch($rows);

        return back()->with('info','Importing Started please wait, will notify when its done!');

    }
}

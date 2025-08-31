<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $PageTitle = 'Products';
        $products = Product::paginate(12);
        return view('Customer.pages.product',compact('PageTitle','products'));
    }

    public function search_product(Request $request)
    {
        $dataquery = Product::query();

        if ($request->has('product_search') && !empty($request->product_search)) {
            $dataquery->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_search . '%')
                  ->orWhere('description', 'like', '%' . $request->product_search . '%')
                  ->orWhere('category', 'like', '%' . $request->product_search . '%');
            });
        }
        $PageTitle = 'Products';
        $products = $dataquery->paginate(12);
        if(!empty($request->product_search))
        {
            $PageTitle = 'Searched For: '.$request->product_search;
        }
        
        return view('Customer.pages.product',compact('PageTitle','products'));
    }

    public function products()
    {
         $PageTitle = 'Products';
        $products = Product::paginate(12);
        return view('Customer.pages.product',compact('PageTitle','products'));
    }

    public function cart()
    {
        $PageTitle = 'cart';

        $cart = Cart::where('customer_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cart->sum(function($i) {
            return $i->product->price * $i->quantity;
        });

        return view('Customer.pages.cart', compact('cart', 'total','PageTitle'));
    }

    public function add_to_cart($productId)
    {
    $product = Product::findOrFail($productId);

    $cart = Cart::where('customer_id', Auth::guard('customer')->id())
        ->where('product_id', $productId)
        ->first();

    if($product->stock != 0)
    {
        if ($cart) {
        $cart->increment('quantity');
    } else {
        Cart::create([
            'customer_id' => Auth::guard('customer')->id(),
            'product_id'  => $productId,
            'quantity'    => 1
        ]);
    }
    }else{
        return response()->json([
        'success' => false,
        'message' => 'Product Stock out',
    ]);
    }
    
    $count = Cart::where('customer_id', Auth::guard('customer')->id())->count();

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart!',
        'count'   => $count
    ]);
    }

    public function cart_count()
    {
        $count = Cart::where('customer_id', Auth::guard('customer')->id())->count();

        return response()->json(['count' => $count]);
    }

    public function remove_to_cart($Id)
    {
        $cart = Cart::where('id', $Id)->where('customer_id', Auth::id())->firstOrFail();

        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function place_order(Request $request)
    {
        $cartItems = Cart::where('customer_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        $order = Order::create([
            'customer_id' => Auth::id(),
            'status'      => 'Pending',
        ]);
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);

           $product_update = Product::findOrFail($item->product_id);
            $product_update->stock = $product_update->stock - $item->quantity;
            $product_update->save();

            $totalPrice += ($item->product->price * $item->quantity);
        }
        $order->grand_total = $totalPrice;
        $order->save();

        Cart::where('customer_id', Auth::id())->delete();

        return redirect()->route('customer.order', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function order($id)
    {
        $order = Order::findOrFail($id);
        $PageTitle = 'Order: '.$order->name;
        return view('Customer.pages.order',compact('order','PageTitle'));
    }

    public function Orders()
    {
        $orders = Order::where('customer_id', Auth::id())->with('products')->latest()->paginate(10);
        $PageTitle = 'Orders';
        return view('Customer.pages.orders', compact('orders','PageTitle'));
    }
}

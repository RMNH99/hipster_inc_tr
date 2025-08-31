@extends('Layouts.customerlayout')
@section('content')
<?php $i=1; ?>
<div class="container mt-3">
    <table class="table-bordered table">
        <thead>
            <tr>
            <th>Sr. no.</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cart as $c)
            <tr>
               <td>{{$i++}}</td>
               <td>{{ $c->product->name }}</td>
               <td>₹{{ number_format($c->product->price, 2) }}</td>
               <td>{{ $c->quantity }}</td>
               <td>₹{{ number_format($c->product->price * $c->quantity, 2) }}</td>
               <td><form action="{{ route('customer.cart_remove', $c->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Your cart is empty!</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
            <h4>Grand Total: ₹{{ number_format($total, 2) }}</h4>

            <form action="{{route('customer.place_order')}}" method="POST">
                @csrf
                <button class="btn btn-success">Place Order</button>
            </form>
        </div>
</div>


@endsection
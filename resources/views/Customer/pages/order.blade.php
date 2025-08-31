@extends('Layouts.customerlayout')
@section('content')
<div class="container">
    <h5>Order ID: #{{$order->id}} - Order at {{ $order->created_at->format('d M Y, h:i A') }}</h5>
    <p>Status
        @if($order->status == "Pending") 
        <span class="text-secondary">Pending</span>
        @elseif($order->status == "Shipped")
        <span class="text-warning">Shipped</span>
        @else
        <span class="text-success">Delivered</span>
        @endif
    </p>
    <p>Total: ₹{{ number_format($order->grand_total, 2) }}</p>

    <h4>Products</h4>
<?php $i=1; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $p)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$p->product->name}}</td>
                <td>₹{{ number_format($p->price, 2) }}</td>
                <td>{{ $p->quantity }}</td>
                <td>₹{{ number_format($p->price * $p->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


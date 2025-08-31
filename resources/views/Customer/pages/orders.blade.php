@extends('Layouts.customerlayout')
@section('content')
<?php $i=1; ?>
<div class="container mt-3">
    <table class="table-bordered table">
        <thead>
            <tr>
            <th>Sr. no.</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Products</th>
            <th>Total</th>
            <th>Date</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $o)
            <tr>
               <td>{{$i++}}</td>
               <td>#{{$o->id}}</td>
               <td>
                @if($o->status == "Pending") 
        <span class="text-secondary">Pending</span>
        @elseif($o->status == "Shipped")
        <span class="text-warning">Shipped</span>
        @else
        <span class="text-success">Delivered</span>
        @endif
               </td>
               <td>
                <ul class="list-unstyled mb-0">
                    @foreach($o->products as $op)
                        <li>
                            {{ $op->product->name }}
                            (x{{ $op->quantity }}) – ₹{{ $op->price }}
                        </li>
                    @endforeach
                </ul>
               </td>
               <td>₹{{ number_format($o->grand_total, 2) }}</td>
               <td>{{ $o->created_at->format('d M Y, h:i A') }}</td>
               <td><a href="{{ route('customer.order', $o->id) }}" class="btn btn-sm btn-primary">View</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Your cart is empty!</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
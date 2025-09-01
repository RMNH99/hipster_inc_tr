@extends('Layouts.adminlayout')
@section('content')
<?php $i=1; ?>
<div class="container mt-3">
    <table class="table-bordered table">
        <thead>
            <tr>
            <th>Sr. no.</th>
            <th>Customer Name</th>
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
               <td>{{$o->customer->name}}</td>
               <td>#{{$o->id}}</td>
               <td id="status-{{$o->id}}">
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
               <td>
                <select class="product-order-status" data-order-id="{{ $o->id }}">
                    <option class="text-secondary border-outline-secondary" value="Pending" {{ $o->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option class="text-warning border-outline-warning" value="Shipped" {{ $o->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option class="text-success border-outline-success" value="Delivered" {{ $o->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
               </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No Orders Yet!</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
@push('script')

<script>
$(document).ready(function(){
    $('.product-order-status').change(function(){
        var status = $(this).val();
        var orderId = $(this).data('order-id');

        $.ajax({
            url: '/admin/update-status/' + orderId,
            method: 'POST',
            data: {
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                toastr.success('Status updated to ' + status, 'Success');
                if(status == "Pending"){
                    html = `<span class="text-secondary">Pending</span>`;
                }else if(status == "Shipped"){
                     html = `<span class="text-warning">Shipped</span>`;
                }else{
                    html = `<span class="text-success">Delivered</span>`;
                }
            
                $('#status-' + orderId).html(html);
            },
            error: function(err) {
                 toastr.error('Something went wrong!', 'Error');
            }
        });
    });
});
</script>

@endpush
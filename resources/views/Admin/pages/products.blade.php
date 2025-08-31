@extends('Layouts.adminlayout')
@section('content')

<table class="table table-stripe">
    <thead>
        <tr>
            <th>Sr. No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Categoru</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        @foreach($products as $key => $product)
        <tr>
            <td>{{$products->firstItem() + $key}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->category}}</td>
            <td>₹ {{$product->price}}</td>
            <td>{{$product->stock}}</td>
            <td><img src="{{ asset('storage/'.$product->image)}}" alt="{{$product->name}}" id="preImg" class="mt-3" style="max-width:100px; min-height:100px; border: 1px solid black; border-radius: 5px;">
                </td>
            <td>
                <a href="{{route('admin.edit_product',[$product->id])}}" class="btn btn-secondary">Edit</a>
                <form action="{{route('admin.delete_product')}}" method="post" onsubmit="return confirm('Really wanna delete?');">
                    @csrf
                    <input type="hidden" name="delId" value="{{$product->id}}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                
            </td>
        </tr>
        @endforeach
       
    </tbody>
     
    
</table>
{{ $products->links('pagination::bootstrap-5') }}

@endsection
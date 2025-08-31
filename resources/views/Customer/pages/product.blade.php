@extends('Layouts.customerlayout')
@section('content')

<div class="row gap-3">

@forelse($products as $product)
<div class="card col-sm-3" style="margin: 0 auto;">
  <img class="card-img-top mt-3" src="{{ asset('storage/'.$product->image)}}" alt="{{ $product->name}}" style="min-height: 100px; margin: 0 auto; border: 1px solid black; border-radius: 10px;">
  <div class="card-body">
    <h5>{{ $product->name}}</h5>
    <p class="card-text">{{ $product->description }}</p>
    <ul class="list-group list-group-flush">
    <li class="list-group-item"><div class="d-flex justify-content-between">
        <div>Price: ₹ {{ $product->price}}</div>
        <div>Stock: {{ $product->stock}}</div>
    </div>
    </li>
    <li class="list-group-item text-center">Category: {{ $product->category}}</li>
  </ul>
  <div class="d-flex justify-content-between">
    <a href="" class="btn btn-success text-center">Order</a>
  <a href="" class="btn btn-secondary text-center">View</a>
  </div>
  <button class="btn w-100 btn-primary add-cart mt-3" data-id="{{ $product->id }}">
    Add to Cart
</button>
  </div>
</div>
@empty
<div class="text-center">
    <h5>No Product Found</h5>
</div>
@endforelse
</div>
<div class="mt-3">
        {{ $products->withQueryString()->links() }}
    </div>
@endsection


<div class="col-md-3">
    <div class="list-group">
        <a href="{{route('admin.home')}}" class="list-group-item list-group-action @if(request()->routeIs('admin.home')) active @endif">Dashboard</a>
        <a href="{{route('admin.add_product')}}" class="list-group-item list-group-action @if(request()->routeIs('admin.add_product')) active @endif">Add Product</a>
        <a href="{{route('admin.import_product')}}" class="list-group-item list-group-action @if(request()->routeIs('admin.import_product')) active @endif">Import Products</a>
        <a href="{{route('admin.products')}}" class="list-group-item list-group-action @if(request()->routeIs('admin.products')) active @endif">All Products</a>
        <a href="{{route('admin.orders')}}" class="list-group-item list-group-action  @if(request()->routeIs('admin.orders')) active @endif">Orders</a>
        <a href="{{route('admin.complete_orders')}}" class="list-group-item list-group-action @if(request()->routeIs('admin.complete_orders')) active @endif">Completed Orders</a>
    </div>

    <div class="mt-3"><b>Online Users/Admins</b></div>
    <div class="mt-3" >
        <ul id="online-users"></ul>
    </div>
</div>

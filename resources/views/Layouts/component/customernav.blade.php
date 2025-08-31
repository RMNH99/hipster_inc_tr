<nav class="navbar navbar-extend-lg navbar-dark bg-dark">
    <div class="container-fluid">
            <a href="{{route('customer.home')}}" class="navbar-brand">Technical Round</a>
            <a href="{{route('customer.home')}}" style="text-decoration:none; color: white">Dashboard</a>
            <a href="{{route('customer.products')}}" style="text-decoration:none; color: white">Products</a>
            <a href="{{route('customer.orders')}}" style="text-decoration:none; color: white">My Orders</a>
            <a href="{{ route('customer.cart') }}" style="text-decoration:none; color: white">
                Cart <span id="count" class="badge bg-info">0</span>
            </a>
            <form action="{{route('customer.search')}}" method="GET" class="d-flex">
                <input type="text" name="product_search" placeholder="Search Here" value="{{request('product_search')}}" class="form-control">&nbsp;
                <button type="submit" class="btn btn-secondary">Search</button>
            </form>
            <a href="{{route('customer.logout')}}" class="float-right" style="text-decoration:none; color: white">Logout</a>
    </div>
</nav>
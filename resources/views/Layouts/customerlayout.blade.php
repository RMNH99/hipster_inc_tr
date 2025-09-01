<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HIPSTER INC TR - {{$PageTitle}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    @stack('style')
</head>    
<body>
    
    @include('Layouts.component.customernav')
    <div class="px-3 mt-4">
            <div class="col-md-12">
                <div class="card">

                <div class="card-header">
                        <h5> {{$PageTitle}}</h5>
                </div>
                <div class="card-body">
                    @yield('content')
                </div>

                </div>
            </div>
       
    </div>

    <?php 
    use Illuminate\Support\Facades\Auth;
    $customer_id = Auth::guard('customer')->id(); ?>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    @stack('script')

    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif

     @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Error');
        </script>
    @endif

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.add-cart', function(e) {
    e.preventDefault();
    let productId = $(this).data('id');

    $.post("/customer/cart-add/" + productId, {}, function(response) {
        if (response.success) {
            $("#count").text(response.count);
            toastr.success(response.message, 'Success');
        }else{
            toastr.error(response.message, 'Error'); 
        }
    });
});

$(document).ready(function() {
    $.get("/customer/cart-count", function(response) {
        $("#count").text(response.count);
    });
})

</script>

<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
  

<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher("b606c3616c71fe4415e4", {
        cluster: "ap2",
        authEndpoint: '/broadcasting/auth',
        auth: {
             headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        },
        withCredentials: true 
    });

    var channel = pusher.subscribe('private-orders.{{ auth()->guard("customer")->id() }}');

    channel.bind('status.update', function(data) {
        toastr.success(
            'Order #' + data.order_id + ' status updated to ' + data.status,
            'Success'
        );
        if(data.status == "Pending"){
                    html = `<span class="text-secondary">Pending</span>`;
                }else if(data.status == "Shipped"){
                     html = `<span class="text-warning">Shipped</span>`;
                }else{
                    html = `<span class="text-success">Delivered</span>`;
                }
            
                $('#status-'+data.order_id).html(html);
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.0/dist/echo.iife.js"></script>
  <script>
    Pusher.logToConsole = true;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env("PUSHER_APP_KEY") }}',
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        }
    });
     Echo.join('presence-users').here((users) => { console.log(users) });
</script>

</body>
</html>
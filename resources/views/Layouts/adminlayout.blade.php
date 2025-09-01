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
    
    @include('Layouts.component.nav')
    <div class="px-3 mt-4">
        <div class="row col-md-12">
            @include('Layouts.component.sidebar')
            <div class="col-md-9">
                <div class="card">

                <div class="card-header">
                        <h5> {{$PageTitle}}</h5>
                </div>
                <div class="card-body">
                    <div id="notifications"></div>
                    @yield('content')
                </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    @stack('script')

    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif

     @if(session('info'))
        <script>
            toastr.info("{{ session('info') }}", 'info');
        </script>
    @endif

     @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Error');
        </script>
    @endif

    @if(session('toast'))
    <script>
        toastr["{{ session('toast')['type'] }}"]("{{ session('toast')['message'] }}");
    </script>
@endif
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher("b606c3616c71fe4415e4", {
            cluster: "ap2",
        });

        var channel = pusher.subscribe('notifications');

        channel.bind('new-notification', function(data) {

            toastr.success(data.message, 'Success');
       
        });

        
    </script>
</body>
</html>
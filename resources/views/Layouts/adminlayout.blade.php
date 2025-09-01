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
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.0/dist/echo.iife.js"></script>

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
</script>
<script>
    const onlineList = document.getElementById('online-users');
    Echo.join('presence-users')
        .here(users => {
            renderUsers(users);
        })
        .joining(user => {
            addUser(user);
        })
        .leaving(user => {
            removeUser(user);
        });

    function renderUsers(users) {
        onlineList.innerHTML = '';
        users.forEach(user => {
            const li = document.createElement('li');
            li.id = `user-${user.id}`;
            li.textContent = `${user.name} (${user.type})`;
            onlineList.appendChild(li);
        });
    }

    function addUser(user) {
        const li = document.createElement('li');
        li.id = `user-${user.id}`;
        li.textContent = `${user.name} (${user.type})`;
        onlineList.appendChild(li);
    }

    function removeUser(user) {
        const li = document.getElementById(`user-${user.id}`);
        if (li){
        li.remove();
            }
        } 
</script>
</body>
</html>
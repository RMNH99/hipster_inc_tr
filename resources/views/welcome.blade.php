<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIPSTER INC TR</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="w-100 d-flex justify-content-around alighn-items-center mt-5">
        <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Admin Console</h5>
                @if (Auth::guard('admin')->check())
                    <a href="{{ route('admin.home') }}" class="btn btn-primary"> Dashboard </a>
                @else
                    <a href="{{ route('admin.login') }}" class="btn btn-primary"> Go to Login </a>
                @endif
            </div>
        </div>

            <div class="card text-center mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Customer Console</h5>
                    @if (Auth::guard('customer')->check())
                        <a href="{{ route('customer.home') }}" class="btn btn-primary">Dashboard </a>
                    @else
                        <a href="{{ route('customer.login') }}" class="btn btn-primary"> Go to Login </a>
                    @endif
                </div>
            </div>

    </div>

        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
</body>

</html>

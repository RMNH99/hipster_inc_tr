<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIPSTER INC TR - {{$PageTitle}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
<div class="w-100">
  <div class="w-25 mt-5" style="margin: 0 auto;">
<form method="post" action="{{route('customer.login.auth')}}">
    @csrf
  <div class="mt-5 text-center">
  <h1>
    {{$PageTitle}}
  </h1>
  </div>
  
  <div class="form-group mt-3">
    <label for="exampleInputEmail1">Email ID</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <button type="submit" class="btn btn-primary mt-3 w-100 text-center">Login</button>
</form>
  </div>
</div>

        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
</body>

</html>

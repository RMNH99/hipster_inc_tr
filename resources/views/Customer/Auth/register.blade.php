@extends('Layouts.loginLayout')
@section('content')
<div class="w-100">
  <div class="w-25 mt-5" style="margin: 0 auto;">
<form method="post" action="{{route('admin.register.auth')}}">
    @csrf
  <div class="mt-5 text-center">
  <h1>
    {{$PageTitle}}
  </h1>
  </div>
  <div class="form-group mt-3">
    <label for="exampleInputname1">Name</label>
    <input type="name" name="name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
  </div>
  <div class="form-group mt-3">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="d-flex justify-content-between mt-3">
    <a href="{{route('customer.login')}}" class="btn btn-primary text-center w-40">Login</a>
<button type="submit" class="btn btn-success text-center w-40">Register</button>
  
  </div>
  
</form>
  </div>
</div>
@endsection

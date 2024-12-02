@extends('backend.layouts.empty')
@section('title', 'Admin Login')
@section('content')
<div class="row mt-5 justify-content-center align-self-center">
<div class="col-sm-6 img-thumbnail">
  <h2 class="text-center">HHP Control Panel</h2>
  <hr>
  <p class="text-center">Please fill out the following fields to login:</p>
  @include('backend.includes.errors')
  <div class="mt-5">
<form method="POST" action="{{ route('admin.login.submit') }}" >
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-6 form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="col-sm-6 form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
    </div>

    <div class="col-sm-12 form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
  </div>

</form>
</div>
</div>
</div>

@endsection

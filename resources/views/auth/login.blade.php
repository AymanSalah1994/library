@extends('layout')
@section('content')
@include('inc/error')
<form method="post" action="{{ route('auth.handleLogin')}}" >
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="email"  placeholder="Enter email" value="{{ old('email')}}">
    </div>
    <br>
    <div class="form-group">
        <input type="password" class="form-control" name="password"  placeholder="Enter password" value="{{ old('password')}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<a href="{{ route('auth.redirect') }}" class="btn btn-info">Sign In Using Gitub</a>
@endsection

@section('title')
    Register Page
@endsection

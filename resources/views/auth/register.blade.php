@extends('layout')
@section('content')
@include('inc/error')
<form method="post" action="{{ route('auth.handleRegister')}}" >
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="name"  placeholder="Enter Name" value="{{ old('name')}}">
    </div>
    <br>
    <div class="form-group">
        <input type="text" class="form-control" name="email"  placeholder="Enter email" value="{{ old('email')}}">
    </div>
    <br>
    <div class="form-group">
        <input type="password" class="form-control" name="password"  placeholder="Enter password" value="{{ old('pass')}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<a href="{{ route('auth.redirect') }}" class="btn btn-info">Register Using Gitub</a>
@endsection

@section('title')
    Register Page
@endsection

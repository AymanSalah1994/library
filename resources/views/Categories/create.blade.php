@extends('layout') ;

@section('title')
Create Category
@endsection
@section('content')
    @include('inc/error')
    <form method="post" action="{{ route('Categories.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name"  placeholder="Enter name" value="{{ old('name') }}">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

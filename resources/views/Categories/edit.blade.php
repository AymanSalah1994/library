@extends('layout') ;

@section('title')
    Edit the Category
@endsection
@section('content')
    @include('inc/error')
    <form method="post" action="{{ route('Categories.update',$editedCategory->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name"  value="{{old('name')?? $editedCategory->name }}">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

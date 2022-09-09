@extends('layout') 

@section('title')
    Edit the Book
@endsection
@section('content')
    @include('inc/error')
    <form method="post" action="{{ route('books.update',$editedBook->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="title"  value="{{old('title')?? $editedBook->title }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="desc" rows="3">{{ old('desc') ?? $editedBook->desc }}</textarea>
        </div>
        <br>
        <div class="form-group">
            <input type="file" class="form-control-file" name="img">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

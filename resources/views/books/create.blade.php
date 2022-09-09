@extends('layout')

@section('title')
Create Book
@endsection

@section('content')
    @include('inc/error')
    <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="title"  placeholder="Enter Title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="desc" rows="3">{{ old('desc') }}</textarea>
        </div>
        <br>
        <div class="form-group">
            <input type="file" class="form-control-file" name="img">
        </div>
        <br>
        @foreach ($categories  as $category )
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}">
                <label class="form-check-label" for="gridCheck">
                    {{ $category->name }}
                </label>
            </div> 
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

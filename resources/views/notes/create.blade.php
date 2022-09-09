@extends('layout')

@section('title')
Create Book
@endsection
@section('content')
    @include('inc/error')
    <form method="post" action="{{ route('Note.store') }}" >
        @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Note:</label>
            <textarea class="form-control" name="content" rows="3">{{ old('content') }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

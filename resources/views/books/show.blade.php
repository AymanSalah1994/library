    @extends('layout')
    @section('content')
    this is show page ;
    <h1>Book title : </h1>
    <h2> {{$book->title }} </h2>
    <br>
   
    <ul>
    @foreach ($book->categories as $category )
    <li>
      {{ $category->name }}
    </li>
    @endforeach
    </ul>
    <a href="{{ route('books.all')}}">Back to Home Page</a>
    @endsection
    
    @section('title')
       Book details
    @endsection

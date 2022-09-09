    @extends('layout')
    @section('content')
    this is show page ;
    <h1>Category title : </h1>
    <h2> {{$category->name }} </h2>
    <br>

<ul>
    @foreach ($category->books as $book)
        <li>
            {{ $book->title }}
        </li>
    @endforeach
    
   </ul>
    <a href="{{ route('Categories.all')}}">Back to Home Page</a>
    @endsection
    
    @section('title')
       Category details
    @endsection

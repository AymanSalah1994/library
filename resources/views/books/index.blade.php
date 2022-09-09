@extends('layout')
@section('content')
   @auth
   <a href="{{ route('books.create') }}" class="btn btn-primary">Create a new Book</a>
   @endauth
   @auth
       <p>Your Nots Here :</p>
       @foreach ( Auth::user()->notes as $note)
           <p>{{ $note->content }}</p>
       @endforeach
       <a href="{{ route('Note.create')}}" class="btn btn-info">+ New Note</a>
   @endauth
@foreach($allBooks as $single_book)
    <hr>
   <h3>
       <a href="{{ route('books.show' , $single_book->id ) }}">
           {{ $single_book->title }}
       </a>
   </h3>
   <p> {{ $single_book->desc }} </p>
    @auth
   @if (Auth::user()->is_admin == 1 )
   <a href="{{ route('books.delete',$single_book->id) }}" class="btn btn-danger">Delete</a>
   @endif
    @endauth
@endforeach

{{ $allBooks->render() }}
@endsection

@section('title')
    Home Page
@endsection

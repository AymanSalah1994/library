@extends('layout')
@section('content')
    <a href="{{ route('Categories.create') }}" class="btn btn-primary">Create a new Category</a>
@foreach($allCategories as $single_category)
    <hr>
   <h3>
       <a href="{{ route('Categories.show' , $single_category->id ) }}">
           {{ $single_category->name }}
       </a>
   </h3>
  
    <a href="{{ route('Categories.delete',$single_category->id) }}" class="btn btn-danger">Delete</a>
@endforeach

{{ $allCategories->render() }}
@endsection

@section('title')
    Home Page
@endsection

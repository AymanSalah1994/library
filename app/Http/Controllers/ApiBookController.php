<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    //
    public function index()
    {
        // $books = Book::select('id', 'title')->get();
        $books = Book::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $request) {
        $request->validate([
            'title'=> 'string|required|max:100',
            'desc'=>'string|required' ,
            'img' => 'required|mimes:jpg,png|image' , 
            'categories' => 'required|array|min:1' , 
            'categories.*' => 'required|exists:categories,id' ,
        ]);

        // TWO 2 steps : 1-Extension for Rename ,, 2-Move to Public Folder ;
        $img_file  = $request->file('img') ;
        $extension =  $img_file->getClientOriginalExtension() ;
        $new_name  = "book-" . uniqid() . ".$extension" ;
        $img_file->move(public_path('uploads/books') , $new_name) ;
        $book  = Book::create(
            [
                'title' => $request->title  ,
                'desc' => $request->desc ,
                'img' =>$new_name , 
                
            ]
        );
        $book->categories()->sync($request->categories) ;
        $success = "Everything is Ok " ; 
        return response()->json($success); ;
    }

    public function update(Request $request , $id){
         $request->validate([
            'title'=> 'string|required|max:100',
            'desc'=>'string|required',
            'img' => 'nullable|mimes:jpg,png|image' , 
            'categories' => 'required|array|min:1' , 
            'categories.*' => 'required|exists:categories,id' ,
        ]);
    
        $book = Book::findorfail($id) ;
        $book_name  = $book->img  ;

        if($request->hasFile('img'))
        {
            if ($book_name !== null) {
                unlink(public_path('uploads/books/') .$book_name ) ;
            }
            $img_file  = $request->file('img') ;
            $extension =  $img_file->getClientOriginalExtension() ;
            $book_name  = "book-" . uniqid() . ".$extension" ;
            $img_file->move(public_path('uploads/books') , $book_name) ;
        }

        $book->update([
            'title'=>$request->title ,
            'desc'=>$request->desc ,
            'img' =>$book_name
        ]) ;
        $book->categories()->sync($request->categories) ;
        $succUpdate =  "Updated Well" ; 
        return response()->json($succUpdate) ;
    }

    public function delete($id){
        $book = Book::findorfail($id) ;
        $book_name  = $book->img  ;
        if ($book_name !== null) {
            // YOu Need  TO refactor this , IF Delete Has Error The File Will Be Deleted Anyway !!! 
            // You Must Fix this Problem !!!
            unlink(public_path('uploads/books/') .$book_name ) ;
        }
        $book->categories()->detach() ;
        // You Detach First ,, THEN you Delete ;!!!!

        $book->delete() ;
        $succDelete =  "Deleted Well" ; 
        return response()->json($succDelete) ;
    }
}

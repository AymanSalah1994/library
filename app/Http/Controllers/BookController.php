<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $allBooks  = Book::paginate(2);
//        $first_Book = Book::Select('id','title')->where('id','=','1')->get() ;
        // Other Queries
        // $allBooks = Book::where('id', '>', 1)->get();
        // Above for ROW specify
        // $allBooks = Book::Select('id', 'title', 'desc')->get();
        // Above for COLUMN specify
        // return $allBooks;
        return view('books/index' ,compact('allBooks')) ;
//        return view('books/index')->with($allBooks) ;
//        return view('books/index' , $data = [$allBooks]) ;
//        dd($first_Book) ;
    }

    public  function show($id) {
//      $book =   Book::where('id','=',$id)->first() ;
        $book = Book::findorfail($id) ;
        return view('books/show' , compact('book')) ;
    }

    public  function  create() {
        $categories  = Category::select('id','name')->get();
        return view('books/create' , compact('categories')) ;
    }

    public  function  store (Request $request) {
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
//        dd($extension) ;
        $new_name  = "book-" . uniqid() . ".$extension" ;
        $img_file->move(public_path('uploads/books') , $new_name) ;
        $book  = Book::create(
            [
                'title' => $request->title  ,
                'desc' => $request->desc ,
                'img' =>$new_name
            ]
        );
        $book->categories()->sync($request->categories) ;
        return redirect(route('books.all')) ;
    }

    public function edit($id) {
        $editedBook = Book::findorfail($id) ;
        // $relatedCategories = $editedBook->categories ;
        // dd($relatedCategories) ;
        return view('books/edit', compact('editedBook')) ;
    }

    public function update(Request $request , $id) {
        // Why there is No CSRF for this ?
        $request->validate([
            'title'=> 'string|required|max:100',
            'desc'=>'string|required',
            'img' => 'nullable|mimes:jpg,png|image'
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
        return redirect(route('books.edit' , $id)) ;
    }

    public  function delete($id) {

        $book = Book::findorfail($id) ;
        $bookName  = $book->img ;
        if($book->img !== null) {
            unlink(public_path('uploads/books/') . $bookName) ;
        }
        $book->categories()->detach() ;
        $book->delete() ;
        return redirect(route('books.all')) ;
    }
}

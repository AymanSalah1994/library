<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\BookController;
/*
| --------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// READ
Route::get('/books', 'App\Http\Controllers\BookController@index')->name('books.all');
Route::get('books/show/{id}', 'App\Http\Controllers\BookController@show')->name('books.show');

// READ
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('Categories.all');
Route::get('Categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('Categories.show');
// Three Ways Now in the New Version for the ROTES :



Route::middleware('isLogin')->group(function () {
    // log out 
    Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');
    // Create
    Route::get('/books/create', 'App\Http\Controllers\BookController@create')->name('books.create');

    Route::post('/books/store', 'App\Http\Controllers\BookController@store')->name('books.store');
    // Update
    Route::get('/books/edit/{id}', 'App\Http\Controllers\BookController@edit')->name('books.edit');

    Route::post('/books/update/{id}', 'App\Http\Controllers\BookController@update')->name('books.update');


    // Create
    Route::get('/Categories/create', 'App\Http\Controllers\CategoryController@create')->name('Categories.create');
    Route::post('/Categories/store', 'App\Http\Controllers\CategoryController@store')->name('Categories.store');
    // Update
    Route::get('/Categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('Categories.edit');
    Route::post('/Categories/update/{id}', 'App\Http\Controllers\CategoryController@update')->name('Categories.update');


    // NOTES 
    Route::get('/notes/create', 'App\Http\Controllers\NoteController@create')->name('Note.create');
    Route::post('/notes/store', 'App\Http\Controllers\NoteController@store')->name('Note.store');
});


Route::middleware('isGuest')->group(function () {
    // Authentication 
    // if the User is Logged in He Will NOT be able to see those pages 
    Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('auth.register');
    Route::post('/handle-register', 'App\Http\Controllers\AuthController@handleRegister')->name('auth.handleRegister');
    //log in 
    Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
    Route::post('/handle-login', 'App\Http\Controllers\AuthController@handleLogin')->name('auth.handleLogin');
});

Route::middleware('isAdmin')->group(function () {
    //Delete
    Route::get('/books/delete/{id}', 'App\Http\Controllers\BookController@delete')->name('books.delete');
    //Delete
    Route::get('/Categories/delete/{id}', 'App\Http\Controllers\CategoryController@delete')->name('Categories.delete');
});
/*

/// Now we will start with the PHP routes For the Categories

*/

Route::get('/auth/redirect', 'App\Http\Controllers\AuthController@redirect')->name('auth.redirect');

Route::get('/auth/callback', 'App\Http\Controllers\AuthController@callback')->name('auth.callback');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bookController;
use App\Http\Controllers\borrowController;

use App\Models\book;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin','App\Http\Controllers\bookController@manageBooks');
Route::post('/admin/books/add','App\Http\Controllers\bookController@addBooks');
Route::post('/admin','App\Http\Controllers\bookController@handleBooks');


Route::get('/user',function(){
    return view('user/description');
});

Route::get('/description',function(){
    return view('user/description');
});

Route::get('/books','App\Http\Controllers\bookController@viewBooks');
Route::get('/books', [bookController::class, 'viewBooks'])->name('books');


Route::get('/borrow/{book_id}', [borrowController::class, 'showForm']);
Route::post('/borrow/{book_id}', [borrowController::class, 'submitForm']);

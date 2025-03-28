<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\borrow;

class borrowController extends Controller
{
    //

    public function showForm($book_id)
    {
        return view('user/borrow', compact('book_id'));
    }

    public function submitForm(Request $request, $book_id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    borrow::create([
        'book_id' => $book_id, // Use the passed book_id from the URL
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('books')->with('success', 'Your request has been submitted successfully.');
}
}

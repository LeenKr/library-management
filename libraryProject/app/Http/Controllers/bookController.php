<?php

namespace App\Http\Controllers;
use App\Models\book;
use Illuminate\Http\Request;

class bookController extends Controller
{
    //
   public function manageBooks(){

        $book = book::all();
        return view('admin/manageBooks',['books' => $book]);
    }

    public function addBooks(Request $request){
        $b = book::create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'copies_available' => $request->copies_available
        ]);

        //checks if the user uploaded a file
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = $b->id.".".$file->extension(); //rename the file as [id.extension]
            //update the photo name in the database
            $b->photo = $name;
            $b->save();
            //move the file to the images directory
            //$file->move("images", $name);
            move_uploaded_file($file, "images/".$name);
        }

        $row = "<tr id='row_{$b->id}'>
                <td>
                    <div class='mb-3 mt-3'>
                        <input type='text' class='form-control' id='txtTitle_{$b->id}'
                                value='{$b->title}' name='txtTitle_{$b->id}'>
                    </div>
                </td>
                <td>
                    <div class='mb-3 mt-3'>
                        <input type='text' class='form-control' id='txtAuthor_{$b->id}'
                                value='{$b->author}' name='txtAuthor_{$b->id}'>
                    </div>
                </td>
                <td>
                    <div class='mb-3 mt-3'>
                        <input type='number' class='form-control' id='txtYear_{$b->id}'
                                value='{$b->year}' name='txtYear_{$b->id}'>
                    </div>
                </td>

                <td>
                    <div class='mb-3 mt-3'>";

            if($b->photo != null && file_exists(public_path()."/images/".$b->photo))
                $row .= "<img src='".asset('images/'.$b->photo)."' alt='' width='75'
                                id='img_{$b->id}'>";

            $row .="<input type='file' class='form-control' id='txtPhoto_{$b->id}'
                            name='txtPhoto_{$b->id}''>
                    </div>
                </td>
                <td>
                    <div class='mb-3 mt-3'>
                        <input type='number' class='form-control' id='txtCopies_{$b->id}'
                                value='{$b->copies_available}' name='txtCopies_{$b->id}'>
                    </div>
                </td>

                <td>
                    <button type='button' class='btn btn-primary' onclick='updateBook({$b->id})'
                                id='btnUpdate_{$b->id}'>Update</button>
                    <button type='button' class='btn btn-primary' onclick='deleteBook({$b->id})'
                                    id='btnDelete_{$b->id}'>Delete</button>
                </td>
            </tr>";

        return response()->json([
            'msg' => 'A book has been added',
            'row' => $row
        ]);
    }


    public function handleBooks(Request $request){
        foreach($request->all() as $key => $value){
            
            $a = explode('_', $key); //$a[1] contains the id of the item
            if($a[0] == "btnUpdate"){


                $b = book::find($a[1]);
                $b->title = request('txtTitle_'.$a[1]);
                $b->author = request('txtAuthor_'.$a[1]);
                $b->year = request('txtYear_'.$a[1]);
                $b->copies_available = request('txtCopies_'.$a[1]);


                //checks if the user uploaded a file
                if($request->hasFile('txtPhoto_'.$a[1])){
                    $file = $request->file('txtPhoto_'.$a[1]);
                    $name = $b->id.".".$file->extension(); //rename the file as [id.extension]

                    $file->move(public_path('images'), $name);
                    //update the photo name in the database
                    $b->photo = $name;

                }
                $b->save();
            }
            else if($a[0] == "btnDelete"){
                $b = book::find($a[1]);
                unlink(public_path("images/".$b->photo));
                $b->delete();
            }
        }
        return redirect()->to('/admin');
    }

    function viewBooks()
    {
        $books = book::all();
        return view('user/viewBooks',['books' => $books]);
    }
}

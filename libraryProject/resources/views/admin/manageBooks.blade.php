@extends('admin/layout')

@section('head_container')
<script>

    $(document).ready(function(){
            $("#btnAdd").click(function(){
                $(this).attr("disabled", "disabled");

                var data_form = new FormData();
                data_form.append("title", $("#txtTitle_0").val());
                data_form.append("author", $("#txtAuthor_0").val());
                data_form.append("year", $("#txtYear_0").val());
                data_form.append("photo", document.getElementById("txtPhoto_0").files[0]);
                data_form.append("copies_available", $("#txtCopies_0").val());

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url:'/admin/books/add',
                    type: 'post',
                    data: data_form,
                    contentType: false, //multipart/form-data
                    processData: false, //without encryption
                    success: function(output){
                        $("#btnAdd").removeAttr("disabled");
                        alert(output.msg);
                        $("#table_rows").append(output.row);
                        location.reload();
                    },
                    error: function(er){
                        alert(er.responseText);
                    }
                });
            });
        });


 function updateBook(id) {
    var data_form = new FormData();
    data_form.append("btnUpdate_" + id, "true");
    data_form.append("txtTitle_" + id, $("#txtTitle_" + id).val());
    data_form.append("txtAuthor_" + id, $("#txtAuthor_" + id).val());
    data_form.append("txtYear_" + id, $("#txtYear_" + id).val());
    data_form.append("txtCopies_" + id, $("#txtCopies_" + id).val());

    var photoInput = document.getElementById("txtPhoto_" + id);

    if (photoInput.files.length > 0) {
        data_form.append("txtPhoto_" + id, photoInput.files[0]);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url: '/admin',
        type: 'POST',
        data: data_form,
        contentType: false,
        processData: false,
        success: function(response) {
            alert("Book updated successfully!");
            location.reload(); // Refresh to see the changes
        },
        error: function(error) {
            alert("Error updating book: " + error.responseText);
        }
    });
}

function deleteBook(id) {
    if (!confirm("Are you sure you want to delete this book?")) {
        return;
    }

    var data_form = new FormData();
    data_form.append("btnDelete_" + id, "true");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url: '/admin',
        type: 'POST',
        data: data_form,
        contentType: false,
        processData: false,
        success: function(response) {
            $("#row_" + id).remove();
            alert("Book deleted successfully!");
        },
        error: function(error) {
            alert("Error deleting book: " + error.responseText);
        }
    });
}

</script>
@endsection

@section('body_container')

    <form action="" method="post" enctype="multipart/form-data">
        <table class="table table-sm table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Photo</th>
                    <th>Copies</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table_rows">
                @foreach ($books as $book)
                    <tr id="row_{{ $book->id }}">
                        <td>{{ $book->id }}</td>
                        <td><input type="text" class="form-control form-control-sm" id="txtTitle_{{ $book->id }}" value="{{ $book->title }}" name="txtTitle_{{ $book->id }}"></td>
                        <td><input type="text" class="form-control form-control-sm" id="txtAuthor_{{ $book->id }}" value="{{ $book->author }}" name="txtAuthor_{{ $book->id }}"></td>
                        <td><input type="number" class="form-control form-control-sm" id="txtYear_{{ $book->id }}" value="{{ $book->year }}" name="txtYear_{{ $book->id }}"></td>
                        <td>
                            @if ($book->photo && file_exists(public_path('images/' . $book->photo)))
                                <img src="{{ asset('images/' . $book->photo) }}" alt="" width="50" class="rounded">
                            @endif
                            <input type="file" class="form-control form-control-sm mt-1" id="txtPhoto_{{ $book->id }}" name="txtPhoto_{{ $book->id }}">
                        </td>
                        <td><input type="number" class="form-control form-control-sm" id="txtCopies_{{ $book->id }}" value="{{ $book->copies_available }}" name="txtCopies_{{ $book->id }}"></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-dark" id="btnUpdate_{{ $book->id }}"
                                name="btnUpdate_{{ $book->id }}" onclick="updateBook({{ $book->id }})">Update</button>

                            <button type="button" class="btn btn-sm btn-dark" id="btnDelete_{{ $book->id }}"
                                name="btnDelete_{{ $book->id }}" onclick="deleteBook({{ $book->id }})">Delete</button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                <tr class="table-dark">
                    <td colspan="7"><strong>Add New Book</strong></td>
                </tr>

                <tr id="row_0">
                    <td>#</td>
                    <td><input type="text" class="form-control form-control-sm" id="txtTitle_0" placeholder="Book title" name="txtTitle_0"></td>
                    <td><input type="text" class="form-control form-control-sm" id="txtAuthor_0" placeholder="Author name" name="txtAuthor_0"></td>
                    <td><input type="number" class="form-control form-control-sm" id="txtYear_0" placeholder="Year" name="txtYear_0"></td>
                    <td><input type="file" class="form-control form-control-sm" id="txtPhoto_0" name="txtPhoto_0"></td>
                    <td><input type="number" class="form-control form-control-sm" id="txtCopies_0" placeholder="Copies" name="txtCopies_0"></td>
                    <td><button type="button" class="btn btn-sm btn-dark" id="btnAdd">Add</button></td>
                </tr>

        </table>
    </form>
@endsection

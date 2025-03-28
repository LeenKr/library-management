@extends('user/layout')
@section('head_content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@endsection
@section('body_content')
<div class="books-container">
    @foreach($books as $b)
    <div class="card book-card">
        <img class="card-img-top" src="{{ asset('/images/'.$b->photo) }}" alt="Book Cover">
        <div class="card-body">
            <h4 class="card-title">{{ $b->title }}</h4>
            <p class="card-text">Year: {{ $b->year }}</p>
            <p class="card-text">Author: {{ $b->author }}</p>
            <a href="/borrow/{{ $b->id }}" class="btn btn-primary">Borrow</a>
        </div>
    </div>
    @endforeach
</div>
@if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
    <script>
        // Display the success message for 5 seconds and then redirect
        setTimeout(function() {
            window.location.href = "{{ route('books') }}"; // Redirect to the books page
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endif

@endsection

@extends('user/layout')

@section('head_content')

<link rel="stylesheet" href="{{ asset('css/library.css') }}">

@endsection
@section('body_content')

<div class="container">
    <div class="row align-items-center library-section">
        <div class="col-md-6">
            <img src="{{ asset('images/library.jpg') }}" class="img-fluid library-image" alt="Library Image">
        </div>
        <div class="col-md-6 library-content">
            <h2>Welcome to SouLeen Library</h2>
            <p>
                Books are the gateway to knowledge, imagination, and personal growth. At SouLeen Library, we offer a vast collection of books across various genres to inspire, educate, and entertain. Reading enhances creativity, improves focus, and expands your understanding of the world.
            </p>
            <p><strong>Why Should You Read Books?</strong></p>
            <ul>
                <li>Boosts cognitive skills and memory.</li>
                <li>Reduces stress and enhances mental well-being.</li>
                <li>Improves vocabulary and communication skills.</li>
                <li>Encourages critical thinking and problem-solving.</li>
            </ul>
        </div>
    </div>
</div>

@endsection

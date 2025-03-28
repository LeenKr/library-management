@extends('user/layout')

@section('head_content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection



@section('body_content')
<div class="form-container">
    <h2>Borrow Book</h2>
    <p>Please fill in your details to proceed with borrowing.</p>

    <form action="{{ url('/borrow/' . $book_id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn-submit">Submit Request</button>
    </form>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="{{asset('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


  @yield('head_content')
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" >SouLeen library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">

            <a class="nav-link" href="/description">Description</a>

          </li>
        <li class="nav-item">

          <a class="nav-link" href="/books">View Books</a>

        </li>
      </ul>
      <ul class="navbar-nav">
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-3">
 @yield('body_content')
</div>

</body>
</html>



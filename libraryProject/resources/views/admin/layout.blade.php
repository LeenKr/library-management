<!DOCTYPE html>
<html>
    <head>
        <title>SouLeen Library 📖</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{csrf_token()}}">
        <link rel="stylesheet" href="{{asset('/css/w3.css')}}">
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/js/jquery-3.7.1.min.js"></script>
        @yield('head_container')
    </head>
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>

<div id="main">
    <div class="w3-black">
        <button id="openNav" class="w3-button w3-black w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>SouLeen Library 📖</h1>
        </div>
    </div>

    <div class="container-fluid mt-3">
        @yield('body_container')  <!-- This will be replaced with content from other pages -->
    </div>

    <div class="alert alert-light" style="text-align:center;">
        <strong>&copy; 2024-2025</strong>
    </div>
</div>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

</body>
</html>

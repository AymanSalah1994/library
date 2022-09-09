<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title>
        @yield('title')
    </title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Library</a>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('books.all')}}">Books <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('Categories.all') }}">Categories <span class="sr-only">(current)</span></a>
              </li>
          </ul>

          <ul class="navbar-nav ml-auto"> 

            @guest
            <li class="nav-item active ">
              <a class="nav-link" href="{{ route('auth.register') }}">Register <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="{{ route('auth.login') }}">Login<span class="sr-only">(current)</span></a>
            </li>
            @endguest

            @auth
            <li class="nav-item active">
              <a class="nav-link disabled">
                Welcome
                {{ Auth::user()->name }}
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('auth.logout') }}">Logout<span class="sr-only">(current)</span></a>
            </li>
            @endauth

           </ul>
        </div>
      </nav>
   <div class="container py-3">
       @yield('content')
   </div>
</body>

<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
</html>

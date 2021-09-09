<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Laravel App - @yield('title')</title>
</head>
<body>
    <div class="m-2">
    <h4>Laravel 8 App</h4>
    </div>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white">
       
        <nav class="nav">
            <a class="nav-link active" href="{{ route('home.index') }}">Home</a>
            <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
            <a class="nav-link" href="{{ route('posts.create') }}">Add Blog</a>
            <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
           
          </nav>
    </div>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>
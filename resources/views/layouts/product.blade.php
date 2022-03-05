<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>E-commerce</title>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Products.com</a>
        @if(Auth::user())
        <span class="navbar-text">Current user: {{ Auth::user()->name }}</span>
          @else
            <span class="navbar-text">Guest</span>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categories</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                        <li><a class="dropdown-item" href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            @if(!Auth::user())
            <a href="/login" class="navbar-text" style="text-decoration: none">Login &nbsp;</a>
            <a href="/register" class="navbar-text" style="text-decoration: none">Register</a>
            @else
                <form method="post" action="/logout"> @csrf <button class="btn btn-secondary mt-2">Logout</button> </form>
                @endif
        </div>
        <form method="get" action="/products/search" class="d-flex">
            <input class="form-control me-2" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" type="text">
            <input class="btn btn-primary" type="submit" value="Search">
        </form>
        @error('keyword')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror
    </div>
</nav>

@yield('content')



</body>
</html>

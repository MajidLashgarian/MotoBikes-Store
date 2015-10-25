<html>
    <head>
        <link rel="stylesheet" href="/css/style.css">
        <title>@yield('title')</title>
    </head>
    <body>
    @section('header')
    <a href="/">Main Page</a>
    @if(isset($isAdmin) && $isAdmin==1)
        <a href="/admin/register_newbike">Register New Motobike</a>
        <a href="/admin/logout">Log out</a>
    @else
        <a href="/admin/login">Login</a>
    @endif
    @show
    <hr>
    <h1>@yield('page-title')</h1>
    <div class="container">
        @yield('main-content')
    </div>
    </body>
</html>
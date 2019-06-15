<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facefly - @yield('title')</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/jquery-3.2.1.min.js') }}"></script>

</head>
<body>
<div class="wrapper">
    <header>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{route('facefly')}}" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (Auth::check()): ?>
                            <li><a href="#">Welcome {{Auth::User()->name}}</a></li>
                            <li><a href="{{route('facefly')}}">Flights</a></li>
                            <!--<li><a href="{{route('logout')}}">Logout</a></li>-->
                            <?php else :?>
                            <li><a href="#guest">Welcome message</a></li>
                            <li><a href="{{route('facefly')}}">Flights</a></li>
                            <li><a href="{{route('login')}}">Log In</a></li>
                            <li><a href="{{route('register-user')}}">Register</a></li>
                            <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    
    <footer>
        <div class="container">
            <p class="text-center">
                Copyright &copy; 2017 | All Right Reserved
            </p>
        </div>
    </footer>
</div>
<!--scripts-->
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flights - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/style.css')}}">
<style type="text/css">

    .text-border {
        position: relative;
        padding: 10px 0;
    }
    .text-border:before {
        content: '';
        position: absolute;
        top: 0;
        border-top: 1px solid red;
        left: 47%;
        right: 47%;
    }
    .text-border:after {
        content: '';
        position: absolute;
        bottom: 0;
        border-bottom: 1px solid red;
        left: 47%;
        right: 47%;
    }

</style>
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
                    <a href="index" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index">Flights</a></li>
                        @if(Auth::guest())
                        <li><a href="login">Log In</a></li>
                        <li><a href="register">Register</a></li>
                        @else
                        <li class="dropdown">
                           <button class="btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="margin-top: 12px; font-weight: bold;">Xin chào {{Auth::user()->name}}
    <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/update-information-user')}}">Cập nhật thông tin</a></li>
                            </ul>

                        </li>
                        <li><a href="{{url('/auth/logout')}}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

@yield('content')
    <footer>
        <div class="container">
            <p class="text-center text-border">
                Copyright &copy; 2017 | All Right Reserved
            </p>
        </div>
    </footer>
</div>
<!--scripts-->
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sitescript.js')}}"></script>
</body>
</html>

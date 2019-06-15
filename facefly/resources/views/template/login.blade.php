@extends('master')
@section('title')
    Login
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Log in to your account</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            
                            <?php if (!empty(Session::get('flag'))):?>
                                <?php var_dump($_COOKIE); ?>
                                <h4 class="alert alert-<?php echo Session::get('flag')?>"><?php echo Session::get('message')?> </h4>
                            <?php endif; ?>
                            <form action="{{route('login')}}" method='post'>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label class="control-label">Email Address:</label>
                                    <input type="email" name="user_email" class="form-control" placeholder="Enter your email address">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input type="password" name="user_password" class="form-control" placeholder="Enter your password">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
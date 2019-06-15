@extends('master')
@section('title')
    Register
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Join as a Wordskills Travel Member</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php if (!empty(Session::get('flag'))):?>
                                <h4 class="alert alert-<?php echo Session::get('flag')?>"><?php echo Session::get('message')?> </h4>
                            <?php endif; ?>
                            <form role="form" action="{{route('register')}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label class="control-label">Email Address:</label>
                                    <input type="email" name='user_email' class="form-control" placeholder="Enter your email address">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input type="password" name='user_pass' class="form-control" placeholder="Enter your password">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Name:</label>
                                    <input type="text" name='user_name' class="form-control" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phone Number:</label>
                                    <input type="tel" name='user_phone' class="form-control" placeholder="Enter your phone number">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
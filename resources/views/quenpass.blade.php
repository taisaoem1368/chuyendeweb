@extends('master')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Nhập Email cần lấy lại mật khẩu</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form name="quenpass" role="form" action="{{route('verify')}}" method="post">
                    @if(Session::has('message'))
                    <div class="alert alert-danger">{{Session::get('message')}}
                    </div>
                    @endif
                                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="form-group">
                                    <label class="control-label">Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email address">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
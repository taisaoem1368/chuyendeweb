<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
@extends('master')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                	<a href="{{url('/admin/')}}">Trở lại</a>
                    <h2>Add connect</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="" method="post">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Chú ý !</strong> Đang có lỗi xảy ra.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}
                    </div>
                    @endif  
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="form-group" >
                                    <label class="control-label">Chọn Quốc Gia: </label>
                                     <select class="form-control" id="country1"  name="country1">
                                    <option value="" disabled="disabled" selected>Chọn quốc gia</option>
								 @foreach($country_list as $v)
								 	<option value="{{$v['country_id']}}">{{$v['country_name']}}</option>
								 @endforeach
                                </select>
                                </div> 
                                <div class="form-group" >
                                    <label class="control-label">Chọn Quốc Gia:</label>
                                     <select class="form-control" id="country2"  name="country1">
                                    <option value="" disabled="disabled" selected>Chọn quốc gia</option>
                                     @foreach($country_list as $v)
								 	<option value="{{$v['country_id']}}">{{$v['country_name']}}</option>
								 	@endforeach
                                </select>
                                </div> 
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

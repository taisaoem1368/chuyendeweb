
@extends('master')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Edit Passenger</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="{{route('postEditPassenger', $person['passenger_id'])}}" method="post">
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
                                    <label class="control-label">Title:</label>
                                    <select style="border: 1px solid #999; border-radius: 15px; padding: 5px 20px;" name="title">
                                    <option value="mr" <?php if($if($person['passenger_title']) == "mr") { echo "selected";} ?>>Mr</option>
                                    <option value="mrs" <?php if($if($person['passenger_title']) == "mrs") { echo "selected";} ?>>Mrs</option>
                                </select>
                                </div> 
                                <div class="form-group">
                                    <label class="control-label">First:</label>
                                    <input type="text" name="fname" class="form-control" value="{{$person['passenger_first_name']}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Last:</label>
                                    <input type="text" name="lname" class="form-control" value="{{$person['passenger_last_name']}}">
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
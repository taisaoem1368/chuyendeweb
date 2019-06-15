<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
@extends('master')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <a href="{{url('/admin/')}}">Trở lại</a>
                    <h2>Add Flight</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" id="add-flight" action="{{route('add-new-flight')}}" method="post">
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
                                    <label class="control-label">Kiểu Bay:</label>
                                    <select class="form-control" id="type-flight"  name="title">
                                    <option value="" disabled="disabled" selected>Chọn Kiểu Bay</option>
                                    <option value="domestic">Nội Địa</option>
                                    <option value="world" >Quốc Tế</option>
                                </select>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label">Airline:</label>
                                    <select class="form-control" id="find-airline" name="airline_id">
                                    <option disabled="disabled" selected>Chọn Kiểu Bay Trước</option>
                                </select>
                                </div> 
                                <div class="form-group" >
                                    <label class="control-label">City From:</label>
                                    <select class="form-control" id="airport-from" name="city_from_id">
                                    <option selected disabled="disabled">Chọn airline Trước</option>
                                </select>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label">City To:</label>
                                    <select class="form-control" id="airport-to" name="city_to_id">
                                    <option selected disabled="disabled">Chọn city from trước</option>
                                </select>
                                </div>
                                <div class="form-group">
                                        <label class="control-label">Departure:</label><span>(Nhập thời gian kiểu int)</span>
                                        <input type="text" id="departure-time" name="departuretime" class="form-control" value="">
                                    </div>
                                <div class="form-group">
                                        <label class="control-label">Landing:</label><span>(Nhập thời gian kiểu int)</span>
                                        <input type="text" id="landing-time" name="landingtime" class="form-control" value="">
                                    </div>
                                <div class="form-group">
                                    <label class="control-label">Cost:</label>
                                    <input type="text" id="cost-fl" name="cost" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Seat:</label>
                                    <input type="text" id="seat-fl" name="seat" class="form-control" value="">
                                </div>
                                <div class="text-right">
                                    <button type="submit"  class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#type-flight').change(function() {
            $('#find-airline').load('/admin/find-airline');
            $('#airport-from option').remove();
            $('#airport-to option').remove();
            $('#airport-from').append(new Option('Chọn airline typerước', ""));
            $('#airport-from option').attr('disabled','disabled');
            $('#airport-to').append(new Option('Chọn city from trước', ""));
            $('#airport-to option').attr('disabled','disabled');
        });

        $('#find-airline').change(function() {
            var type = $('#type-flight').val();
            var airline = $('#find-airline').val();
            $('#airport-from').load('find-airport/'+ type +'/airline/'+airline);

            $('#airport-to').load('find-airport/'+ type +'/airline/'+airline);
        });

        $('#add-flight').submit(function() {
            if($.isNumeric($('#airport-to').val()) == false || $.isNumeric($('#airport-from').val()) == false)
            {
                alert("Điền đầy đủ thông tin");
                return false;
            }
            if($('#airport-from').val() == $('#airport-to').val())
            {
                alert("Điểm đi và đến không được trùng nhau");
                return false;
            }

            if($.isNumeric($('#departure-time').val()) == false || Math.floor($('#departure-time').val()) != $('#departure-time').val())
            {
                alert("Thời gian phải là số nguyên");
                return false;
            }
            if($.isNumeric($('#landing-time').val()) == false || Math.floor($('#landing-time').val()) != $('#landing-time').val())
            {
                alert("Thời gian phải là số nguyên");
                return false;
            }
            if($.isNumeric($('#cost-fl').val()) == false || Math.floor($('#cost-fl').val()) < 1)
            {
                alert("Cost phải là số nguyên dương!");
                return false;
            }
            if($.isNumeric($('#seat-fl').val()) == false || Math.floor($('#seat-fl').val()) < 1)
            {
                alert("Seat phải là số nguyên dương!");
                return false;
            }

            return true;
        });
        var exist = "{{Session::has('addSuccessfully')}}";
        if(exist)
        {
            alert("Thêm chuyến bay thành công");
        }

    });
</script>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
@extends('master')
@section('content')
<?php if(Session::has('booking_choose')) { Session::forget('booking_choose');  }?>
    <main>
        <div class="container">
            <section>
                <h3>Flight Booking</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form name="form-light" id="booking" role="form" action="{{route('timChuyenBay')}}" method="get"> <!-- flight-list -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. Flight Destination</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
										<select class="form-control" name="from" id="from">
                                            <option value="" disabled="disabled" selected="true">Chọn Thành Phố</option>
                                            @foreach($cities as $value)
											<option value="{{$value['city_id']}}">{{$value['city_name'].' ('.$value['city_code'].')'}}</option>
											@endforeach
										</select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <select class="form-control" name="to" id="to">
                                            <option value="" disabled="disabled" selected>Chọn Thành Phố</option>
                                           @foreach($cities as $value)
                                            <option value="{{$value['city_id']}}">{{$value['city_name'].' ('.$value['city_code'].')'}}</option>
                                            @endforeach
										</select>       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">2. Date of Flight</h4>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                        <input type="date" name="dateoneway" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Choose Departure Date">
                                    </div>
                                    <div class="form-group">
                                        <div class="radio" onclick="changeRadio();">
                                            <label><input type="radio" name="flight_type" checked value="one-way">One Way</label>
                                            <label><input type="radio" name="flight_type" value="return">Return</label>
                                        </div>
                                    </div>
                                    <div class="form-group return">

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">3. Search Flights</h4>
                                    <div class="form-group">
                                        <label class="control-label">Total Person: </label>
                                        <select class="form-control" name="person_tolal">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Flight Class: </label>
                                        <select class="form-control" name="flight_class">
                                            <option value="1">Economy</option>
                                            <option value="2">Business</option>
                                            <option value="3">Premium Economy</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Search Flights</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var exist = '{{Session::has('errors')}}';
      if(exist)
      {
        alert('Vui lòng nhập ngày!');

      }

/*
        $('#from').change(function() {
        var id = $('#from').val();
        $('#to').load('connect-flight/'+id);
    });
*/

  

  });
</script>
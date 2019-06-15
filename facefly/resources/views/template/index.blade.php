@extends('master')
@section('title')
    Facefly
@endsection
@section('content')
    <main>
        <div class="container">
            <section>
                <h3>Flight Booking</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <form role="form" action="{{url('/search')}}" method="get">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. Flight Destination</h4>
                                    <div class="form-group">
                                        <?php if (!empty(Session::get('error1'))) :?>
                                        <h5 class="alert alert-danger"><?php echo Session::get('error1')?></h5>
                                        <?php endif;?>
                                        <label class="control-label">From: </label>
                                            <select class="form-control" name="from" id="from">
                                                @foreach($airport_list as $airport)
                                                    <option value="{{$airport['airport_id']}}">{{$airport['airport_name']}} ({{$airport['airport_code']}})</option>

                                                @endforeach
                                            </select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <select class="form-control" name="to" id="to">
                                            @foreach($airport_list as $airport)
                                                <option value="{{$airport['airport_id']}}">{{$airport['airport_name']}} ({{$airport['airport_code']}})</option>

                                            @endforeach
                                        </select>       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">2. Date of Flight</h4>
                                        <?php if (!empty(Session::get('error2'))) :?>
                                        <h5 class="alert alert-danger"><?php echo Session::get('error2')?></h5>
                                        <?php endif;?>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                        <input id="date_departure" name="date_departure" type="date" class="form-control" value="<?php echo date('Y-m-d')?>" min="<?php echo date('Y-m-d')?>" placeholder="Choose Departure Date">
                                    </div>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input id="radoneway" type="radio" name="flight_type" checked value="one-way" onchange="returnRadio('oneway')">One Way</label>
                                            <label><input id="radreturn" type="radio" name="flight_type" value="return" onchange="returnRadio('return')">Return</label>
                                        </div>
                                    </div>
                                    <div class="form-group return-date">
                                        <label class="control-label">Return: </label>
                                        <input id="date_return" name="date_return" type="date" class="form-control" value="<?php echo date('Y-m-d')?>" min="<?php echo date('Y-m-d')?>" placeholder="Choose Return Date">
                                    </div>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">3. Search Flights</h4>
                                    <div class="form-group">
                                        <label class="control-label">Total Person: </label>
                                        <select name='person' class="form-control">
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
                                        <select name="flight_class_id" class="form-control">
                                            @foreach ($class_list as $cl)
                                            <option value="{{$cl['class_id']}}">{{$cl['class_name']}}</option>
                                            @endforeach
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
  
    <script>
        $().ready(function(){
            $(".return-date").remove();
        })
        function returnRadio(x){
            var now = new Date($.now());
            var year = now.getFullYear();
            var month = now.getMonth()+1;
            month = (month<10 ? '0' : '') + month;
            var day = now.getDate();
            day = (day<10 ? '0' : '') + day;
            
            var today = year+'-'+month+'-'+day;
            var returninput = "<div class='form-group return-date'><label class='control-label'>Return: </label><input id='date_return' name='date_return' type='date' class='form-control' value='"+today+"' min='"+today+"' placeholder='Choose Return Date'></div>";
            if (x === 'return')
                $(".col-sm-4").eq(1).append(returninput);
            else
            {
                $(".return-date").remove();
            }
        }
    </script>    
@endsection
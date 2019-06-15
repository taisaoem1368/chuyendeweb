<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
@extends('master')
@section('content')
    <main>
        <div class="container">
            <section>
                <h2><?php echo "Vietnam - ".$name_from['city_name'] ?> <i class="glyphicon glyphicon-arrow-right"></i>{{" Vietnam - ". $name_to['city_name']}}</h2>
                
                 @if($_GET['transit'] > 0)
                 <?php 
                    $tongtien = 0;
                    for($i = 0; $i < count($transit_dt); $i++)
                    {
                        $tongtien += $transit_dt[$i]['fl_cost'];
                    }

                  ?>
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong>{{$informationDetail->get_fl_airline_id['airline_name']}}</strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time">{{date('H:i:s', $informationDetail['fl_departure_date'])}}</big></div>
                                            <div><span class="place">{{$informationDetail->get_fl_airport_from['airport_name']." (".$informationDetail->get_fl_city_id_from['city_code'].")"}}</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time">{{date('H:i:s', $transit_dt[count($transit_dt) - 1]['fl_landing_date'])}}</big></div>
                                            <div><span class="place">{{$informationDetail->get_fl_airport_to['airport_name']." (".$informationDetail->get_fl_city_id_to['city_code'].")"}}</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time">{{date('H:i:s',mktime(0,0,$transit_dt[count($transit_dt) - 1]['fl_landing_date']-$informationDetail['fl_departure_date']))}}</big></div>
                                            <div><strong class="text-danger">{{$_GET['transit']." Transit"}}</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>{{number_format($tongtien)." VND"}}</strong></h3>
                                            <div>
                                                <a href="flight-book?from={{$_GET['from']}}&to={{$_GET['to']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}<?php if(isset($_GET['datereturn'])) { echo "&datereturn=".$_GET['dateoneway']; } ?>&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$informationDetail['fl_id']}}&transit={{count($transit_dt)-1}}" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                    </div>


                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#flight-detail-tab">Flight Details</a></li>
                                        <li><a data-toggle="tab" href="#flight-price-tab">Price Details</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="flight-detail-tab" class="tab-pane fade in active">
                                            <ul class="list-group">
                                               

                                                <li class="list-group-item">
                                                    <h5>
                                                        <strong class="airline">{{$transit_dt[0]->get_fl_airline_id['airline_name']}}</strong>
                                                        <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                                        <!--echo get_name_fc($_GET['flight_class']);-->
                                                    </h5>
                                                
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">{{date('H:i:s', $transit_dt[0]['fl_departure_date'])}}</big></div>
                                                                    <div><small class="date">{{date('Y-m-d', $transit_dt[0]['fl_departure_date'])}}</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{$transit_dt[0]->get_fl_airport_from['airport_name']." (".$transit_dt[0]->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                                    <div><small class="airport">{{$transit_dt[0]->get_fl_airport_to['airport_name']}}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">{{date('H:i:s', $transit_dt[0]['fl_landing_date'])}}</big></div>
                                                                    <div><small class="date">{{date('Y-m-d', $transit_dt[0]['fl_landing_date'])}}</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{$transit_dt[0]->get_fl_city_id_to['city_name']." (".$transit_dt[0]->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                                    <div><small class="airport">{{$transit_dt[0]->get_fl_city_id_to['city_airport']}}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <label class="control-label">Duration:</label>
                                                            <div><strong class="time">{{date('H\h i\m', mktime(0,0,$transit_dt[0]['fl_landing_date']-$transit_dt[0]['fl_departure_date']))}}</strong></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php for($i = 1; $i < count($transit_dt); $i++) 
                                                {?>
                                                <li class="list-group-item list-group-item-warning">
                                                    <ul>
                                                        <li>Transit for {{date('H\h i\m', mktime(0,0,$transit_dt[$i]['fl_departure_date'] - $transit_dt[$i-1]['fl_landing_date']))}} in {{$transit_dt[$i]->get_fl_city_id_to['city_name']." (".$transit_dt[$i]->get_fl_city_id_to['city_code'].")"}}</li>
                                                    </ul>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5>
                                                        <strong class="airline">{{$transit_dt[$i]->get_fl_airline_id['airline_name']}}</strong>
                                                        <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">{{date('H:i:s', $transit_dt[$i]['fl_departure_date'])}}</big></div>
                                                                    <div><small class="date">{{date('Y-m-d', $transit_dt[$i]['fl_departure_date'])}}</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{$transit_dt[$i]->get_fl_city_id_from['city_name']." (".$transit_dt[$i]->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                                    <div><small class="airport">{{$transit_dt[$i]->get_fl_airport_from['airport_name']}}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">{{date('H:i:s', $transit_dt[$i]['fl_landing_date'])}}</big></div>
                                                                    <div><small class="date">{{date('Y-m-d', $transit_dt[$i]['fl_landing_date'])}}</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{$transit_dt[$i]->get_fl_city_id_to['city_name']." (".$transit_dt[$i]->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                                    <div><small class="airport">{{$transit_dt[$i]->get_fl_airport_to['airport_name']}}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <label class="control-label">Duration:</label>
                                                            <div><strong class="time">{{date('H\h i\m', mktime(0,0,$transit_dt[$i]['fl_landing_date']-$transit_dt[$i]['fl_departure_date']))}}</strong></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="flight-price-tab" class="tab-pane fade">
                                            <h5>
                                                <strong class="airline">{{$transit_dt[0]->get_fl_airline_id['airline_name']}}</strong>
                                                <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                            </h5>




                                            <!--price details-->
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <strong>Passengers Fare (x<?php echo $_GET['person_tolal']; ?>)</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong>{{number_format($tongtien*$_GET['person_tolal'])." VND"}}</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <span>Tax</span>
                                                    </div>
                                                    <div class="pull-right">
                                                        <span>Included</span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item list-group-item-info">
                                                    <div class="pull-left">
                                                        <strong>You Pay</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <?php $tongtien = ($informationDetail['fl_cost'] + $informationDetail['fl_cost']*$_GET['flight_class'] * 0.1)*$_GET['person_tolal']; ?>
                                                        <strong>{{number_format($tongtien*$_GET['person_tolal'])." VND"}}</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </div>
                                                 <?php } ?>
                                                @else
                                                                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong>{{$informationDetail->get_fl_airline_id['airline_name']}}</strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time">{{date('H:i:s', $informationDetail['fl_departure_date'])}}</big></div>
                                            <div><span class="place">{{$informationDetail->get_fl_airport_from['airport_name']." (".$informationDetail->get_fl_city_id_from['city_code'].")"}}</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time">{{date('H:i:s', $informationDetail['fl_landing_date'])}}</big></div>
                                            <div><span class="place">{{$informationDetail->get_fl_airport_to['airport_name']." (".$informationDetail->get_fl_city_id_to['city_code'].")"}}</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time">{{date('H:i:s',mktime(0,0,$informationDetail['fl_landing_date']-$informationDetail['fl_departure_date']))}}</big></div>
                                            <div><strong class="text-danger">{{$_GET['transit']." Transit"}}</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>{{number_format($informationDetail['fl_cost'])." VND"}}</strong></h3>
                                            <div>
                                                <a href="flight-book?from={{$_GET['from']}}&to={{$_GET['to']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}<?php if(isset($_GET['datereturn'])) { echo "&datereturn=".$_GET['dateoneway']; } ?>&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$informationDetail['fl_id']}}&transit=0" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                    </div>


                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#flight-detail-tab">Flight Details</a></li>
                                        <li><a data-toggle="tab" href="#flight-price-tab">Price Details</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="flight-detail-tab" class="tab-pane fade in active">
                                            <ul class="list-group">
                                                 <li class="list-group-item">
                                                    <h5>
                                                        <strong class="airline">{{$informationDetail->get_fl_airline_id['airline_name']." VN".$informationDetail['fl_id']}}</strong>
                                                        <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                                        <!--echo get_name_fc($_GET['flight_class']);-->
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">{{date('H:i:s', $informationDetail['fl_departure_date'])}}</big></div>
                                                                    <div><small class="date">{{$_GET['dateoneway']}}</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{$informationDetail->get_fl_city_id_from['city_name']." (".$informationDetail->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                                    <div><small class="airport">{{$informationDetail->get_fl_airport_from['airport_name']}}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">{{date('H:i:s', $informationDetail['fl_landing_date'])}}</big></div>
                                                                    <div><small class="date">{{$_GET['dateoneway']}}</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{$informationDetail->get_fl_city_id_to['city_name']." (".$informationDetail->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                                    <div><small class="airport">{{$informationDetail->get_fl_airport_to['airport_name']}}</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <label class="control-label">Duration:</label>
                                                            <div><strong class="time">{{date('H\h i\m',mktime(0,0,$informationDetail['fl_landing_date']-$informationDetail['fl_departure_date']))}}</strong></div>
                                                        </div>
                                                    </div>
                                                </li>
                                           
                                         
                                            </ul>
                                        </div>
                                        <div id="flight-price-tab" class="tab-pane fade">
                                            <h5>
                                                <strong class="airline">{{$informationDetail->dsChuyenBay['dschuyenbay_tenhang']." ".$informationDetail['thongtinchuyenbay_machuyenbay']}}</strong>
                                                <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                            </h5>




                                            <!--price details-->
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <strong>Passengers Fare (x<?php echo $_GET['person_tolal']; ?>)</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong>{{number_format($informationDetail['fl_cost']*$_GET['person_tolal'])." VND"}}</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <span>Tax</span>
                                                    </div>
                                                    <div class="pull-right">
                                                        <span>Included</span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item list-group-item-info">
                                                    <div class="pull-left">
                                                        <strong>You Pay</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <?php $tongtien = ($informationDetail['fl_cost'] + $informationDetail['fl_cost']*$_GET['flight_class'] * 0.1)*$_GET['person_tolal']; ?>
                                                        <strong>{{number_format($tongtien)." VND"}}</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
@endsection
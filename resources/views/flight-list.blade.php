<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
@extends('master')
@section('content')

    <main>
        <div class="container">
            <section>
                                             
               
                <h2><?php echo "Vietnam - ".$name_from['city_name'] ?> <i class="glyphicon glyphicon-arrow-right"></i>{{" Vietnam - ". $name_to['city_name']}}</h2>
                  <?php $flag = 0; ?>

                @if(count($notransit) > 0 || count($transit) > 0)
                @foreach($notransit as $value)
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong><a href="flight-detail.html">{{$value->get_fl_airline_id['airline_name']}}</a></strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time">{{date('H:i:s',$value['fl_departure_date'])}}</big></div>
                                            <div><span class="place">{{$value->get_fl_airport_from['airport_name']." (".$value->get_fl_city_id_from['city_code'].")"}}</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time">{{date('H:i:s',$value['fl_landing_date'])}}</big></div>
                                            <div><span class="place">{{$value->get_fl_airport_to['airport_name']." (".$value->get_fl_city_id_to['city_code'].")"}}</span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time"><?php echo date('H:i:s',mktime(0,0,$value['fl_landing_date']-$value['fl_departure_date'])); ?></big></div>
                                            <div><strong class="text-danger">0 Transit</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>{{number_format($value['fl_cost']). " VNĐ"}}</strong></h3>
                                            <div>
                                                <a href="flight-detail?from={{$name_from['city_id']}}&to={{$name_to['city_id']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}<?php if(isset($_GET['datereturn'])) { echo "&datereturn=".$_GET['dateoneway']; } ?>&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$value['fl_id']}}&transit=0" class="btn btn-link">See Detail</a>
                                                <a href="flight-book?from={{$name_from['city_id']}}&to={{$name_to['city_id']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}<?php if(isset($_GET['datereturn'])) { echo "&datereturn=".$_GET['dateoneway']; } ?>&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$value['fl_id']}}&transit=0" class="btn btn-primary">Choose</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @if(count($transit) > 0 && $flag == 0)
                 <?php 
                    $flag = 1;
                    $tongtien = 0;
                    for($i = 0; $i < count($transit); $i++)
                    {
                        $tongtien += $transit[$i]['fl_cost'];
                    }

                  ?>
                     <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><strong><a href="flight-detail.html">{{$value->get_fl_airline_id['airline_name']}}</a></strong></h4>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">From:</label>
                                                <div><big class="time">{{date('H:i:s',$transit[0]['fl_departure_date'])}}</big></div>
                                                <div><span class="place">{{$value->get_fl_airport_from['airport_name']." (".$value->get_fl_city_id_from['city_code'].")"}}</span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time">{{date('H:i:s',$transit[count($transit)-1]['fl_landing_date'])}}</big></div>
                                                <div><span class="place">{{$value->get_fl_airport_to['airport_name']." (".$value->get_fl_city_id_to['city_code'].")"}}</span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Duration:</label>
                                                <div><big class="time">{{date('H:i:s',mktime(0,0,$transit[count($transit)-1]['fl_landing_date']-$transit[0]['fl_departure_date']))}}</big></div>
                                                <div><strong class="text-danger">{{count($transit)-1}} Transit</strong></div>
                                            </div>
                                            <div class="col-sm-3 text-right">
                                                <h3 class="price text-danger"><strong>{{number_format($tongtien)." VNĐ"}}</strong></h3>
                                                <div>
                                                    <a href="flight-detail?from={{$name_from['city_id']}}&to={{$name_to['city_id']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}<?php if(isset($_GET['datereturn'])) { echo "&datereturn=".$_GET['dateoneway']; } ?>&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$value['fl_id']}}&transit={{count($transit)-1}}" class="btn btn-link">See Detail</a>
                                                    <a href="flight-book?from={{$name_from['city_id']}}&to={{$name_to['city_id']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}<?php if(isset($_GET['datereturn'])) { echo "&datereturn=".$_GET['dateoneway']; } ?>&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$value['fl_id']}}&transit={{count($transit)-1}}" class="btn btn-primary">Choose</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endif
                @endforeach
                @else
                <p style="font-size: 2em; color: gray;">Hiện tại chưa có chuyến bay như địa điểm đã chọn</p>
                @endif
                <div class="text-center">
                    <ul class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">&lsaquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">&rsaquo;</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </section>
        </div>
    </main>
@endsection
@extends('master')
@section('title')
    Flight Detail
@endsection
@section('content')
    <main>
        <?php
//        var_dump($airport_from);
//        var_dump($airport_to);
//        var_dump($flight);
//        var_dump($id_flight);
//        var_dump($person);
//        echo $airport_from;
//        die();
        $date = new DateTime();
//        $date->format('U = d-m-Y H:i:s');
        ?>
        <div class="container">
            <section>
                <h2><?php echo $airport_from['airport_name']." "."( ".$airport_from['airport_code']." )" ?><i class="glyphicon glyphicon-arrow-right"></i><?php echo $airport_to['airport_name']." "."( ".$airport_to['airport_code']." )" ?></h2>
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong><?php echo $flight['flight_airline']?></strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time"><?php echo $flight['flight_from_time']?></big></div>
                                            <div><span class="place"><?php echo $airport_from['airport_name']." "."( ".$airport_from['airport_code']." )" ?></span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time"><?php echo $flight['flight_to_time']?></big></div>
                                            <div><span class="place"><?php echo $airport_to['airport_name']." "."( ".$airport_to['airport_code']." )" ?></span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <?php 
                                                                    $time1= $flight['flight_to_time'];
                                                                    $time2= $flight['flight_from_time'];
                                                                    $date->setTimestamp(strtotime($time1)-strtotime($time2)); ?>
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time"><?php echo $date->format('H:i:s'); ?></big></div>
                                            <div><strong class="text-danger">1 Transit</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>USD<?php echo $flight['flight_price']?></strong></h3>
                                            <div>
                                                <a href="flight-book" class="btn btn-primary">Choose</a>
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
                                                        <strong class="airline"><?php echo $flight['flight_airline']?> QR-957</strong>
                                                        <p><span class="flight-class">Economy</span></p>
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <?php 
                                                                    $time= $flight['flight_from_time'];
                                                                    $date->setTimestamp(strtotime($time));
//                                                                  var_dump($date->format('d-m-Y'));
//                                                                  die();
                                                                ?>
                                                                <div class="col-sm-4">
                                                                    
                                                                    <div><big class="time"><?php echo $date->format('d-m-Y');?></big></div>
                                                                    <div><small class="date"><?php echo $date->format('H:i:s'); ?></small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place"><?php echo $airport_from['airport_name']." "."( ".$airport_from['airport_code']." )" ?></span></div>
                                                                    <div><small class="airport">Airport</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                                        </div>
                                                                                                                
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <?php 
                                                                    $time= $flight['flight_to_time'];
                                                                    $date->setTimestamp(strtotime($time)); ?>
                                                                <div class="col-sm-4">
                                                                    <div><big class="time"><?php echo $date->format('d-m-Y');?></big></div>
                                                                    <div><small class="date"><?php echo $date->format('H:i:s'); ?></small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place"><?php echo $airport_to['airport_name']." "."( ".$airport_to['airport_code']." )" ?></span></div>
                                                                    <div><small class="airport"><?php echo $flight['flight_airline']?></small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            
                                                            <label class="control-label">Duration:</label>
                                                            <div><strong class="time"><?php echo $date->format('H:i:s'); ?></strong></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                                                                
                                            </ul>
                                        </div>
                                        <div id="flight-price-tab" class="tab-pane fade">
                                            <h5>
                                                <strong class="airline"><?php echo $flight['flight_airline']?></strong>
                                                <p><span class="flight-class">Economy</span></p>
                                            </h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <strong>Passengers Fare (x <?php echo $person ?>)</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong>USD<?php echo ($flight['flight_price']*$person)?></strong>
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
                                                        <strong>USD<?php echo ($flight['flight_price']*$person*0.1)+($flight['flight_price']*$person)?></strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </div>
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
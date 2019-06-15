@extends('master')
@section('title')
    Flight Booking
@endsection
@section('content')
    <main>
        <div class="container">
            <h2>Booking</h2>
            <?php // if (Auth::check()): ?>
            <div class="row">
                <div class="col-md-8">
                    <form role="form" action="{{route('book')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <section>
                            <?php $price_addtax = ($person*$flight['flight_price']*10+$person*$flight['flight_price']); ?>
                            <input type="hidden" name="user_id" value="<?php if (!empty($user_id)){echo $user_id;} else {echo 0;}?>">    
                            <input type="hidden" name="person" value="<?php if (!empty($person)){echo $person;} else {echo 1;}?>">
                            <input type="hidden" name="booking_departure_id" value="<?php if (!empty($flight)){echo $flight['flight_id'];}?>">
                            <input type="hidden" name="booking_return_id" value="<?php if (!empty($flight['flight_return_id'])){echo $flight['flight_return_id'];} else {echo -1;}?>">
                            <input type="hidden" name="booking_price" value="<?php echo $price_addtax; ?>">
                            <h3>Contact Information</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                First Name:
                                            </label>
                                            <input type="text" name='contact_firstname' class="contact contact_name form-control" value="<?php if (!empty($user_name)){echo $user_name;} else {echo "Guest";}?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Last Name:
                                            </label>
                                            <input type="text" name='contact_lastname' class="contact form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's Mobile phone number
                                            </label>
                                            <input type="tel" name='contact_phone' class="contact contact_phone form-control" value="<?php if (!empty($user_phone)){echo $user_phone;} else {echo 0;}?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's email address
                                            </label>
                                            <input type="email" name='contact_email' class="contact contact_email form-control" value="<?php if (!empty($user_email)){echo $user_email;} else {echo 'example@a.a';}?>">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-default" onclick="$('.contact').val('')">Clear all</button>
                                        <button type="button" class="btn btn-default" onclick="contactFill()">Reset</button>
                                        <script>
                                            function contactFill(){
                                                var name = '<?php if (!empty($user_name)){echo $user_name;} else {echo "Guest";}?>';
                                                var phone = '<?php if (!empty($user_phone)){echo $user_phone;} else {echo 0;}?>';
                                                var email = '<?php if (!empty($user_email)){echo $user_email;} else {echo 'example@a.a';}?>';
                                                
                                                $('.contact_name').val = name;
                                                $('.contact_phone').val = phone;
                                                $('.contact_email').val = email;      
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h3>Passenger(s) Details</h3>
                            <div class="panel panel-default">
                                @for ($i=0;$i<$person;$i++)
                                <div class="panel-body">
                                    <h4>Passenger #<?php echo $i+1; ?></h4>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Title:</label>
                                            <select name='passengers[{{$i}}][title]' class="form-control">
                                                <option value="mr">Mr.</option>
                                                <option value="mrs">Mrs.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">First Name:</label>
                                            <input name='passengers[{{$i}}][firstname]' type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Last Name:</label>
                                            <input name='passengers[{{$i}}][lastname]' type="text" class="form-control">
                                        </div>
                                        <input type="hidden" name="passengers[{{$i}}][user_id]" value="<?php if (!empty($user_id)){echo $user_id;} else {echo 0;}?>">
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </section>
                        <section>
                            <h3>Price Details</h3>
                            <div>
                                <h5>
                                    <strong class="airline"><?php echo $flight['flight_airline']?></strong>
                                    <p><span class="flight-class"><?php echo $flight['flight_class']?></span></p>
                                </h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <strong>Passengers Fare (x <?php echo $person ?>)</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong>USD<?php echo $person*$flight['flight_price'] ?></strong>
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
                                            <strong>USD<?php echo $price_addtax; ?></strong>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <section>
                            <h3>Payment</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Payment Method:
                                        </label>
                                        <select name='credit_method' class="form-control">
                                            <option value="transfer">Transfer</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="paypal">Paypal</option>
                                        </select>
                                    </div>
                                    <h4>Credit Card</h4>
                                    <div class="form-group">
                                        <label class="control-label">Card Number</label>
                                        <input name="credit_number" type="number" class="form-control" placeholder="Digit card number">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <label class="control-label">Name on card:</label>
                                            <input name="credit_holder" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="control-label">CVV Code:</label>
                                            <input name="credit_cvv" type="number" maxlength="3" class="form-control" placeholder="Digit CVV">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    Continue to Booking
                                </button>
                            </div>
                        </section>
                    </form>
                </div>
                <div class="col-md-4">
                    <h3>Flights</h3>
                    <aside>
                        <article>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline"><?php echo $flight['flight_airline']?></strong>
                                            <p><span class="flight-class"><?php echo $flight['flight_class']?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <?php 
                                                        $date= strtotime($flight['flight_from_time']);
                                                    ?>
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php echo date('H:i:s',$date); ?></big></div>
                                                        <div><small class="date"><?php echo date('d-m-Y',$date);?></small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"><?php echo $airport_from['airport_name']." "."( ".$airport_from['airport_code']." )" ?></span></div>
                                                        <div><small class="airport">Intl Airport</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <?php 
                                                        $date = strtotime($flight['flight_to_time']);
                                                    ?>
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php echo date('H:i:s',$date); ?></big></div>
                                                        <div><small class="date"><?php echo date('d-m-Y',$date);?></small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"><?php echo $airport_to['airport_name']." "."( ".$airport_to['airport_code']." )" ?></span></div>
                                                        <div><small class="airport">International Airport</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
<!--                                    <li class="list-group-item list-group-item-warning">
                                        <ul>
                                            <li>Transit for 1h 30m in Doha (DOH)</li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">Qatar Airways QR-1052</strong>
                                            <p><span class="flight-class">Economy</span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">00:50</big></div>
                                                        <div><small class="date">30 Apr 2017</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">Doha (DOH)</span></div>
                                                        <div><small class="airport">Doha Hamad International Airport</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">02:55</big></div>
                                                        <div><small class="date">30 Apr 2017</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">Abu Dhabi (AUH)</span></div>
                                                        <div><small class="airport">Abu Dhabi Intl</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>-->
                                </ul>
                            </div>
                        </article>
                    </aside>
                </div>
            </div>
            <?php // else: ?>
            <h3 class="alert alert-warning">Cần đăng nhập để thực hiện bước này</h2>
            <?php // endif; ?>
        </div>
        <br>
    </main>
@endsection
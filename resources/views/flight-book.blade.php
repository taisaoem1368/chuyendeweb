@extends('master')
@section('content')
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); 
$total_person = $_GET['person_tolal'];
if($total_person > 10)
{
    $total_person = 10;
}
if($total_person < 1)
{
    $total_person = 1;
}

?>
<?php $getChoose1 = Session::get('booking_choose'); ?>

    <main>
        <div class="container">
            <h2>Booking</h2>
            <div class="row">
                <div class="col-md-8">
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



                    <form id="booking-start" role="form" action="continue-to-booking?from={{$_GET['from']}}&to={{$_GET['to']}}&dateoneway={{$_GET['dateoneway']}}&flight_type={{$_GET['flight_type']}}&datereturn=2019-03-14&person_tolal={{$_GET['person_tolal']}}&flight_class={{$_GET['flight_class']}}&id={{$_GET['id']}}&transit={{$_GET['transit']}}" method="post">
                       <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <section>
                            <h3>Contact Information</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                First Name:
                                            </label>
                                            <input type="text" id="first-user" class="form-control" value="{{Auth::user()->name}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Last Name:
                                            </label>
                                            <input type="text" id="last-user" class="form-control" value="{{Auth::user()->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's Mobile phone number
                                            </label>
                                            <input type="tel" id="phone-user" class="form-control" value="{{Auth::user()->phone}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's email address
                                            </label>
                                            <input type="email" id="email-user" class="form-control" value="{{Auth::user()->email}}">
                                        </div>
                                    </div>
                                    <div class="text-right">
										<button type="button" class="btn btn-default" onclick="clearAll();">Clear all</button>
                                        <button type="button" class="btn btn-default" onclick="resetAll();">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                       <?php for($i = 0; $i < $total_person; $i++) { ?>

                        <section>
                            <h3>Passenger(s) Details</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Passenger # <?php echo $i+1; ?></h4>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Title:</label>
                                            <select class="form-control" name="passenger_input[{{$i}}]['title']">
                                                <option value="mr">Mr.</option>
                                                <option value="mrs">Mrs.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">First Name:</label>
                                            <input type="text" id="first-name" class="form-control" name="passenger_input[{{$i}}]['firstname']" minlength="3" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Last Name:</label>
                                            <input type="text" class="form-control" minlength="3" name="passenger_input[{{$i}}]['lastname']" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                        <section>
                            <h3>Price Details</h3>
                            <div>
                                <h5>
                        
                                    <strong class="airline">{{$informationDetail->get_fl_airline_id['airline_name']." ".$informationDetail['fl_id']}}</strong>
                                    <p><span class="flight-class">Economy</span></p>
                                </h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <strong>Passengers Fare (x{{$total_person}})</strong>
                                        </div>
                                        <div class="pull-right">
                                            <?php 
                                            if($_GET['flight_type'] == "return") {
                                                if($_GET['transit'] > 0)
                                                {
                                                    $tongtien2 = 0;
                                                    for($i = 0; $i < count($transit_2); $i++)
                                                    {
                                                        $tongtien2 += $transit_2[$i]['fl_cost'];
                                                    }
                                                }
                                                else
                                                {
                                                    $tongtien2 = $info_2['fl_cost'];
                                                }
                                                $tongtien1 = 0;
                                                if($getChoose1[1] > 0)
                                                {
                                                    for($j = 0; $j < count($transit_dt); $j++)
                                                    {
                                                        $tongtien1 += $transit_dt[$j]['fl_cost'];
                                                    }
                                                }
                                                else
                                                {
                                                    $tongtien1 = $informationDetail['fl_cost'];
                                                }
                                            }
                                            else 
                                            {
                                                if($_GET['transit'] > 0)
                                                {
                                                    $tongtien2 = 0;
                                                    for($i = 0; $i < count($transit_dt); $i++)
                                                    {
                                                        $tongtien2 += $transit_dt[$i]['fl_cost'];
                                                    }
                                                }
                                                else
                                                {
                                                    $tongtien2 = $informationDetail['fl_cost'];
                                                }

                                            }

                                            ?>
                                            <strong><?php if($_GET['flight_type'] == "return") { echo number_format(($tongtien1 + $tongtien2)*$total_person)." VNĐ";} else { echo number_format($tongtien2)." VNĐ"; } ?></strong>
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
                                            <strong><?php if($_GET['flight_type'] == "return") { echo number_format(($tongtien1 + $tongtien2)*$total_person)." VNĐ";} else { echo number_format($tongtien2)." VNĐ"; } ?></strong>
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
                                        <select class="form-control" name="payment" id="payment">
                                            <option value="credit_card">Credit Card</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="paypal">Paypal</option>
                                        </select>
                                    </div>
                                    <div class="creditcart">
                                        <h4>Credit Card</h4>
                                    <div class="form-group">
                                        <label class="control-label">Card Number</label>
                                        <input type="number" name="card_number" id="card_number" maxlength="11" class="form-control" placeholder="Digit card number">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <label class="control-label">Name on card:</label>
                                            <input type="text" name="namecard" id="namecard" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="control-label">CCV Code:</label>
                                            <input type="number" name="ccv" id="ccv" maxlength="4" class="form-control" placeholder="Digit CCV">
                                        </div>
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
                    @if($getChoose1[1] < 1)
                    <aside>
                        <article>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">{{$informationDetail->get_fl_airline_id['airline_name']. " ".$informationDetail['fl_id']}}</strong>
                                            <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">{{date('H:i:s', $informationDetail['fl_departure_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y/m/d', $informationDetail['fl_departure_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$informationDetail->get_fl_city_id_from['city_name']." (".$informationDetail->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                        <div><small class="airport">
                                                            {{$informationDetail->get_fl_airport_from['airport_name']}}
                                                        </small></div>
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
                                                        <div><big class="time">{{date('H:i:s', $informationDetail['fl_landing_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y/m/d', $informationDetail['fl_landing_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$informationDetail->get_fl_city_id_to['city_name']." (".$informationDetail->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                        <div><small class="airport">{{$informationDetail->get_fl_airport_to['airport_name']}}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </article>
                        @else
<!---->
                        <aside>
                        <article>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">{{$transit_dt[0]->get_fl_airline_id['airline_name']. " ".$transit_dt[0]['fl_id']}}</strong>
                                            <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">{{date('H:i:s', $transit_dt[0]['fl_departure_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y/m/d', $transit_dt[0]['fl_departure_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$transit_dt[0]->get_fl_city_id_from['city_name']." (".$transit_dt[0]->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                        <div><small class="airport">
                                                            {{$transit_dt[0]->get_fl_airport_from['airport_name']}}
                                                        </small></div>
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
                                                        <div><big class="time">{{date('H:i:s', $transit_dt[0]['fl_landing_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y/m/d', $transit_dt[0]['fl_landing_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$transit_dt[0]->get_fl_city_id_to['city_name']." (".$transit_dt[0]->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                        <div><small class="airport">{{$transit_dt[0]->get_fl_airport_to['airport_name']}}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php for($i = 1; $i < count($transit_dt); $i++) { ?>
                                    <li class="list-group-item list-group-item-warning">
                                        <ul>
                                            <li>Transit for {{date('H\h i\m', mktime(0,0,$transit_dt[$i]['fl_departure_date'] - $transit_dt[$i-1]['fl_landing_date']))}} in {{$transit_dt[$i]->get_fl_city_id_to['city_name']." (".$transit_dt[$i]->get_fl_city_id_to['city_code'].")"}}</li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">{{$transit_dt[$i]->get_fl_airline_id['airline_name']. " ".$transit_dt[$i]['fl_id']}}</strong>
                                            <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">{{date('H:i:s', $transit_dt[$i]['fl_departure_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y-m-d', $transit_dt[$i]['fl_departure_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$transit_dt[$i]->get_fl_city_id_from['city_name']." (".$transit_dt[$i]->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                        <div><small class="airport">{{$transit_dt[$i]->get_fl_airport_to['airport_name']}}</small></div>
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
                                                        <div><big class="time">{{date('H:i:s', $transit_dt[$i]['fl_landing_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y-m-d', $transit_dt[$i]['fl_landing_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$transit_dt[$i]->get_fl_city_id_to['city_name']." (".$transit_dt[$i]->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                        <div><small class="airport">{{$transit_dt[$i]->get_fl_airport_to['airport_name']}}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </article>
                        @endif
                        @if(isset($_GET['datereturn']))
                                                    <!---->
                        <aside>
                            <h3>Return:</h3>
                        <article>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline"><?php if ($_GET['transit'] > 0) { echo $transit_2[0]->get_fl_airline_id['airline_name']. " ".$transit_2[0]['fl_id']; } else { echo $info_2->get_fl_airline_id['airline_name']. " ".$info_2['fl_id']; } ?></strong>
                                            <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php if($_GET['transit'] > 0) { echo date('H:i:s', $transit_2[0]['fl_departure_date']); } else { echo date('H:i:s', $info_2['fl_departure_date']); } ?> </big></div>
                                                        <div><small class="date"><?php if($_GET['transit'] > 0) { echo date('Y/m/d', $transit_2[0]['fl_departure_date']); } else { echo date('Y/m/d', $info_2['fl_departure_date']); } ?></small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"><?php if($_GET['transit'] > 0) { echo $transit_2[0]->get_fl_city_id_from['city_name']." (".$transit_2[0]->get_fl_city_id_from['city_code'].")"; } else { echo $info_2->get_fl_city_id_from['city_name']." (".$info_2->get_fl_city_id_from['city_code'].")"; } ?></span></div>
                                                        <div><small class="airport">
                                                            <?php if($_GET['transit'] > 0) { echo $transit_2[0]->get_fl_airport_from['airport_name']; } else { echo $info_2->get_fl_airport_to['airport_name']; } ?>
                                                        </small></div>
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
                                                        <div><big class="time"><?php if($_GET['transit'] > 0) { echo date('H:i:s', $transit_2[0]['fl_landing_date']); } else { echo date('H:i:s', $info_2['fl_landing_date']);} ?></big></div>
                                                        <div><small class="date"><?php if($_GET['transit'] > 0) { echo date('Y/m/d', $transit_2[0]['fl_landing_date']);} else { echo date('Y/m/d', $info_2['fl_landing_date']);} ?></small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"><?php if($_GET['transit'] > 0) { echo $transit_2[0]->get_fl_city_id_to['city_name']." (".$transit_2[0]->get_fl_city_id_to['city_code'].")"; } else { echo $info_2->get_fl_city_id_to['city_name']." (".$info_2->get_fl_city_id_to['city_code'].")";;} ?></span></div>
                                                        <div><small class="airport"><?php if($_GET['transit'] > 0) { echo $transit_2[0]->get_fl_airport_to['airport_name'];} else { echo $info_2->get_fl_airport_to['airport-name']; } ?></small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if($_GET['transit'] > 0)
                                    <?php for($i = 1; $i < count($transit_2); $i++) { ?>
                                    <li class="list-group-item list-group-item-warning">
                                        <ul>
                                            <li>Transit for {{date('H\h i\m', mktime(0,0,$transit_2[$i]['fl_departure_date'] - $transit_2[$i-1]['fl_landing_date']))}} in {{$transit_2[$i]->get_fl_city_id_to['city_name']." (".$transit_2[$i]->get_fl_city_id_to['city_code'].")"}}</li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">{{$transit_2[$i]->get_fl_airline_id['airline_name']. " ".$transit_2[$i]['fl_id']}}</strong>
                                            <p><span class="flight-class"><?php if($_GET['flight_class'] == 1) {echo "Economy";} else if($_GET['flight_class'] == 2){ echo "Business";} else { echo "Premium Economy";} ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">{{date('H:i:s', $transit_2[$i]['fl_departure_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y-m-d', $transit_2[$i]['fl_departure_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$transit_2[$i]->get_fl_city_id_from['city_name']." (".$transit_2[$i]->get_fl_city_id_from['city_code'].")"}}</span></div>
                                                        <div><small class="airport">{{$transit_2[$i]->get_fl_airport_from['airport_name']}}</small></div>
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
                                                        <div><big class="time">{{date('H:i:s', $transit_2[$i]['fl_landing_date'])}}</big></div>
                                                        <div><small class="date">{{date('Y-m-d', $transit_2[$i]['fl_landing_date'])}}</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{$transit_2[$i]->get_fl_city_id_to['city_name']." (".$transit_2[$i]->get_fl_city_id_to['city_code'].")"}}</span></div>
                                                        <div><small class="airport">{{$transit_2[$i]->get_fl_airport_to['airport_name']}}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    @endif
                                </ul>
                            </div>
                        </article>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
        <br>
    </main>
@endsection
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#payment').change(function(){
        var value = $('#payment').val();
        if(value == "credit_card")
        {
            $('.creditcart').css('display', 'block');
        }
        else
        {
            $('.creditcart').css('display', 'none');
        }


        

});
  var exist = '{{Session::has('success')}}';
  if(exist){
    alert("Đặt vé thành công!");
    window.location="index";
  }
});
function clearAll() 
{
    $('#first-user').removeAttr("value");
    $('#last-user').removeAttr("value");
    $('#phone-user').removeAttr("value");
    $('#email-user').removeAttr("value");
}

function resetAll() {
    $('#first-user').attr("value", "{{Auth::user()->name}}");
    $('#last-user').attr("value", "{{Auth::user()->name}}");
    $('#phone-user').attr("value", "{{Auth::user()->phone}}");
    $('#email-user').attr("value", "{{Auth::user()->email}}");
}

function validateForm() {
    var field_first_name = $('#first-name').val();
    alert(field_last_name);
    var filter_first_name = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/;
    var field_last_name = $('#last-name').val();
    var filter_last_name = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/;
    if(filter_first_name.test(field_first_name) == false)
    {
        $('#first-name').parent().addClass('has-error');
        return false;
    }
    else
    {
        $('#first-name').parent().removeClass('has-error');
    }
    if(filter_last_name.test(field_last_name) == false)
    {
        $('#last-name').parent().addClass('has-error');
        return false;
    }
    else
    {
        $('#last-name').parent().removeClass('has-error');
    }
    return true;
}
/*
$('#booking-start').submit(function() {
        if($('#payment').val() == 'credit_card')
        {
            var field_cardNumber = $('#card_number').val();
            var filter_carNumber = /^d{11}$/;
            var field_name = $('#cardname').val();
            var filter_name = /^w+$/;
            var field_ccv = $('#ccv').val();
            var filter_ccv = /^d{3,4}$/;
            if(filter_carNumber.test(field_cardNumber) == false)
            {
                $('#card_number').parent().addClass('has-error');
                return false;
            }
            else
            {
                 $('#card_number').parent().removeClass('has-error');
            }

            if(filter_name.test(field_name) == false)
            {
                $('#cardname').parent().addClass('has-error');
                return false;
            }
            else 
            {
                $('#cardname').parent().removeClass('has-error');
            }

            if(filter_ccv.test(field_ccv) == false)
            {
                 $('#ccv').parent().addClass('has-error');
                return false;
            }
            else 
            {              
                $('#ccv').parent().removeClass('has-error');
            }
            return true;

        }
    })
*/
</script>



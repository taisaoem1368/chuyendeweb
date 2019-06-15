<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/style.css')}}">
	<style type="text/css">
	main {
		margin-top: 50px;
	}
	.main-content {
		position: relative;

	}
	.main-content::after {
		content: '';
		position: absolute;
		top: -25px;
		right: 0;
		left: 0;
		border: 2px solid red;

	}
</style>
</head>
<body>

	<div class="container">
		<a href="http://chuyende.local:82/admin/booking">Trở lại</a>
		<h4>Passenger Tables</h4>
	</div>
	<!--Table passenger-->
	<style type="text/css">
	#action-button {
		background: #999; border-radius: 5px; padding: 6px 10px; text-decoration: none; font-weight: bold; color: #fcf8e3;
	}
	#action-button:hover {
		background: #fd9b06;
		transition: 200ms ease;
	}
	#delete-passenger {
		display: inline;
	}
	#delete-passenger button {
		border-radius: 5px;
		padding: 3.5px 5px;
		background: #999;
		color: #fcf8e3;
		font-weight: bold;
		border: none;
		
	}
	#delete-passenger button:hover {
		background: #fd9b06;
		transition: 200ms ease;
	}
</style>
<div class="container">
	<section>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@foreach($passengers as $value)
				<tr>
					<th scope="row">{{++$i}}</th>
					<td>{{$value['passenger_title']}}</td>
					<td>{{$value['passenger_first_name']}}</td>
					<td>{{$value['passenger_last_name']}}</td>
					<td>
						@if($action['fb_action'] != 1)
						<a href="{{route('getEditPassenger', $value['passenger_id'])}}" id="action-button" target=" _blank">Edit</a>

						<form id="delete-passenger" action="{{route('deletePassenger')}}" method="post">
							<input type="hidden" name=" _token" value="{{csrf_token()}}">
							<input type="hidden" name="passenger-id" value="{{$value['passenger_id']}}">
							<button>Delete</button>
						</form>

						@endif 
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
</div>
<!--End Table passenger-->
<!--Flight-Details-->
<?php $fl_first = $bk_fl_connect[0];
$fl_last = $bk_fl_connect[(count($bk_fl_connect)-1)];
$currency = 0;
foreach ($bk_fl_connect as $key => $value) {
	$currency += $value->get_bfe_fl['fl_cost'];
}
?>


<main>
	<div class="container">
		<section class="main-content">
			<h2>{{$fl_first->get_name_from_city_id($fl_first->get_bfe_fl['fl_city_id_from'])}}<i class="glyphicon glyphicon-arrow-right"></i> {{$fl_last->get_name_from_city_id($fl_last->get_bfe_fl['fl_city_id_to'])}}</h2>
			<article>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<h4><strong>{{$fl_first->get_fl_airlines_name($fl_first->get_bfe_fl['fl_airline_id'])}}</strong></h4>
								<div class="row" style="margin-bottom: 20px">
									<div class="col-sm-3">
										<label class="control-label">From:</label>
										<div><big class="time">{{date('H:i:s', $fl_first->get_bfe_fl['fl_departure_date'])}}</big></div>
										<div><span class="place">{{$fl_first->get_city_name_code($fl_first->get_bfe_fl['fl_city_id_from'])}}</span></div>
									</div>
									<div class="col-sm-3">
										<label class="control-label">To:</label>
										<div><big class="time">{{date('H:i:s', $fl_last->get_bfe_fl['fl_landing_date'])}}</big></div>
										<div><span class="place">{{$fl_first->get_city_name_code($fl_last->get_bfe_fl['fl_city_id_to'])}}</span></div>
									</div>
									<div class="col-sm-3">
										<label class="control-label">Duration:</label>
										<div><big class="time">{{date('H:i:s',mktime(0,0,$fl_last->get_bfe_fl['fl_landing_date']-$fl_first->get_bfe_fl['fl_departure_date']))}}</big></div>
										<div><strong class="text-danger">{{count($bk_fl_connect) -1}} Transit</strong></div>
									</div>
									<div class="col-sm-3 text-right">
										<h3 class="price text-danger"><strong>{{number_format($currency)." vnđ"}}</strong></h3>

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
													<strong class="airline">{{$fl_first->get_fl_airlines_name($fl_first->get_bfe_fl['fl_airline_id'])." ".$fl_first->get_bfe_fl['fl_id']}}</strong>
													<p><span class="flight-class">{{$fl_first->get_fc_name($fl_first->get_bfe_bk['fb_type'])}}</span></p>
												</h5>
												<div class="row">
													<div class="col-sm-4">
														<div class="row">
															<div class="col-sm-4">
																<div><big class="time">{{date('H:i', $fl_first->get_bfe_fl['fl_departure_date'])}}</big></div>
																<div><small class="date">{{date('d M Y', $fl_first->get_bfe_fl['fl_departure_date'])}}</small></div>
															</div>
															<div class="col-sm-6">
																<div><span class="place">{{$fl_first->get_city_name_code($fl_first->get_bfe_fl['fl_city_id_from'])}}</span></div>
																<div><small class="airport">{{$fl_first->get_airport_name($fl_first->get_bfe_fl['fl_city_id_from'])}}</small></div>
															</div>
														</div>
													</div>
													<div class="col-sm-1">
														<i class="glyphicon glyphicon-arrow-right"></i>
													</div>
													<div class="col-sm-4">
														<div class="row">
															<div class="col-sm-4">
																<div><big class="time">{{date('H:i', $fl_first->get_bfe_fl['fl_landing_date'])}}</big></div>
																<div><small class="date">{{date('d M Y', $fl_first->get_bfe_fl['fl_landing_date'])}}</small></div>
															</div>
															<div class="col-sm-6">
																<div><span class="place">{{$fl_first->get_city_name_code($fl_first->get_bfe_fl['fl_city_id_to'])}}</span></div>
																<div><small class="airport">{{$fl_first->get_airport_name($fl_first->get_bfe_fl['fl_city_id_to'])}}</small></div>
															</div>
														</div>
													</div>
													<div class="col-sm-3 text-right">
														<label class="control-label">Duration:</label>
														<div><strong class="time">{{date('H\h i\m',mktime(0,0,($fl_first->get_bfe_fl['fl_landing_date'])-($fl_first->get_bfe_fl['fl_departure_date'])))}}</strong></div>
													</div>
												</div>
											</li>
											<?php for($i = 1; $i < count($bk_fl_connect); $i++) {?>
												<li class="list-group-item list-group-item-warning">
													<ul>
														<li>Transit for {{date('H\h i\m', mktime(0,0,($bk_fl_connect[$i]->get_bfe_fl['fl_departure_date'])-($bk_fl_connect[$i-1]->get_bfe_fl['fl_landing_date'])))}} in {{$bk_fl_connect[$i]->get_city_name_code($bk_fl_connect[$i]->get_bfe_fl['fl_city_id_from'])}}</li>
													</ul>
												</li>
												<li class="list-group-item">
													<h5>
														<strong class="airline">{{$bk_fl_connect[$i]->get_fl_airlines_name($bk_fl_connect[$i]->get_bfe_fl['fl_airline_id'])." ".$bk_fl_connect[$i]->get_bfe_fl['fl_id']}}</strong>
														<p><span class="flight-class">{{$bk_fl_connect[$i]->get_fc_name($bk_fl_connect[$i]->get_bfe_bk['fb_type'])}}</span></p>
													</h5>
													<div class="row">
														<div class="col-sm-4">
															<div class="row">
																<div class="col-sm-4">
																	<div><big class="time">{{date('H:i', $bk_fl_connect[$i]->get_bfe_fl['fl_departure_date'])}}</big></div>
																	<div><small class="date">{{date('d M Y', $bk_fl_connect[$i]->get_bfe_fl['fl_departure_date'])}}</small></div>
																</div>
																<div class="col-sm-6">
																	<div><span class="place">{{$bk_fl_connect[$i]->get_city_name_code($bk_fl_connect[$i]->get_bfe_fl['fl_city_id_from'])}}</span></div>
																	<div><small class="airport">{{$bk_fl_connect[$i]->get_airport_name($bk_fl_connect[$i]->get_bfe_fl['fl_city_id_from'])}}</small></div>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<i class="glyphicon glyphicon-arrow-right"></i>
														</div>
														<div class="col-sm-4">
															<div class="row">
																<div class="col-sm-4">
																	<div><big class="time">{{date('H:i', $bk_fl_connect[$i]->get_bfe_fl['fl_landing_date'])}}</big></div>
																	<div><small class="date">{{date('d M Y', $bk_fl_connect[$i]->get_bfe_fl['fl_landing_date'])}}</small></div>
																</div>
																<div class="col-sm-6">
																	<div><span class="place">{{$bk_fl_connect[$i]->get_city_name_code($bk_fl_connect[$i]->get_bfe_fl['fl_city_id_to'])}}</span></div>
																	<div><small class="airport">{{$bk_fl_connect[$i]->get_airport_name($bk_fl_connect[$i]->get_bfe_fl['fl_city_id_to'])}}</small></div>
																</div>
															</div>
														</div>
														<div class="col-sm-3 text-right">
															<label class="control-label">Duration:</label>
															<div><strong class="time">{{date('H\h i\m',mktime(0,0,($bk_fl_connect[$i]->get_bfe_fl['fl_landing_date'])-($bk_fl_connect[$i]->get_bfe_fl['fl_departure_date'])))}}</strong></div>
														</div>
													</div>
												</li>
											<?php } ?>
										</ul>
									</div>
									<div id="flight-price-tab" class="tab-pane fade">
										<h5>
											<strong class="airline">{{$fl_first->get_fl_airlines_name($fl_first->get_bfe_fl['fl_airline_id'])}}</strong>
											<p><span class="flight-class">{{$fl_first->get_fc_name($fl_first->get_bfe_bk['fb_type'])}}</span></p>
										</h5>
										<ul class="list-group">
											<li class="list-group-item">
												<div class="pull-left">
													<strong>Passengers Fare (x{{count($passengers)}})</strong>
												</div>
												<div class="pull-right">
													<strong>{{number_format(count($passengers)*$currency)." vnđ"}}</strong>
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
													<strong>Total</strong>
												</div>
												<div class="pull-right">
													<strong>{{number_format(count($passengers)*$currency)." vnđ"}}</strong>
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
<!--End-Flight-Details-->
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#delete-passenger').submit(function() {
			if(confirm("Are you sure you want to delete this?")){
				return true;
			}
			else{
				return false;
			}
		});
	});
</script>
</body>
</html>
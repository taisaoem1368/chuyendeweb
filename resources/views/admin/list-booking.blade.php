@extends('admin.master')
@section('content')
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Tables</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Tables
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Basic Tables start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Booking Tables</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						<li><a data-action="close"><i class="ft-x"></i></a></li>
					</ul>
				</div>
			</div>
			<style type="text/css">
				.card-content .card-body .search-dv form a
				{
					position: relative;
					border-radius: 15px;
					margin-left: 10px;padding: 10px 12px; color: #f58e99;
					border: 1px solid #dedede;
					
				}
				.card-content .card-body .search-dv form a:hover::before
				{
					content: '';
					position: absolute;
					border-radius: 15px;
					top: -5px;
					bottom: -5px;
					left: -5px;
					right: -5px;
					border: 1px solid #528cc1;
				}
				.card-content .card-body .search-dv form a:hover {
					background: #528cc1;
					border-radius: 15px;
					border: 2px solid #528cc1;
					transition: 250ms ease;

				}
			</style>
			<div class="card-content collapse show">
				<div class="card-body">
					<div class="search-dv" style="margin-bottom: 20px; ">
						<form name="search" style="display: inline; border-radius: 15px">
							<input type="text" name="searchkey" id="search-info" placeholder="Nhập SDT or Email User" style="border: 1px solid #f58e99; padding: 6px 30px 6px 20px;">
							<a href="#"><i class="fa fa-search" aria-hidden="true" style="font-size: 15px;"></i></a>
							<a href="#"><i class="fas fa-sync-alt" style="font-size: 15px;"></i></a>
						</form>
						<span>Lọc: <i class="fas fa-filter"></i>
						<select>
							<option>Vé trong ngày</option>
							<option>Vé mới nhất</option>
							<option>Vé deplay</option>
						</select>
						</span>

					</div>
					<style type="text/css">
						#table-booking tbody form button {
							font-weight: bold;
							color: #6967ce;
							border: none;
							background: none;
						}
					</style>
					<!-- <p><span class="text-bold-600">Airlines List:</span> Table with outer spacing</p> -->
					<div class="table-responsive">
						<table class="table" id="table-booking">
							<thead>
								<tr>
									<th>#</th>
									<th>From</th>
									<th>To</th>
									<th>DateTime</th>
									<th>Details</th>
									<th>Email</th>
									<th>SDT</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>

									@foreach($tableBooking as $value)
									<tr>
										<td scope="row">{{$i++}}</td>
										<td>{{$value->get_fb_city_from['city_name']}}</td>
										<td>{{$value->get_fb_city_to['city_name']}}</td>
										<td>{{date('d/m/Y H:i:s',$value['fb_departure_date'])}}</td>
										<td><a href="{{Route('details', $value['fb_id'])}}">Xem <i class="fas fa-forward"></a></i></td>
										<td>{{$value->get_fb_user['email']}}</td>
										<td>{{$value->get_fb_user['phone']}}</td>
										<td id="delete-booking">
											<a href="{{route('deletebk',$value['fb_id'])}}">Delete</a>
										</td>
									</tr>
									@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Basic Tables end -->
<!-- Striped rows start -->
</div>
<!-- Striped rows end -->

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

@endsection
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
    	$('.search-dv form a').eq(0).click(function(e) {
    		e.preventDefault();
    		var key = $('.search-dv form input').val();
    		if(key == "")
    			key = "6868a";
    		$('#table-booking').load('booking-search/'+key);
    	});
    	$('.search-dv form a').eq(1).click(function(e) {
    		e.preventDefault();
    		$('#table-booking').load('load-booking');
    	});
    	$('#table-booking tbody #delete-booking').click(function() {
    		if(confirm("Are you sure you want to delete this?")){
	        	return true;
		    }
		    else{
		        return false;
	   		}
    	});
    });
</script>
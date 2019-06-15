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
				<h4 class="card-title">Doanh Thu</h4>
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
		</div>
	</div>
</div>
<!-- Basic Tables end -->
<!-- Striped rows start -->

<div class="move-all">
	<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Doanh Thu Airline</h4>
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
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table table-striped" id="table-airports">
						<thead>
							<tr>
								<th>#</th>
								<th>Airline</th>
								<th>Doanh Thu</th>
							</tr>
						</thead>
						<tbody id="tbody-passenger">
							<tr>
								<td>1</td>
								<td>Mr.</td>
								<td>Mr.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div>
	<div>Thành phố có lượng máy bay ĐI nhiều nhất: <span style="color: #6967ce; font-weight: bold;">{{$name_from['city_name']}}</span></div>
	<div>Thành phố có lượng máy bay ĐẾN nhiều nhất: <span style="color: #6967ce; font-weight: bold;">{{$name_to['city_name']}}</span></div>
</div>
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
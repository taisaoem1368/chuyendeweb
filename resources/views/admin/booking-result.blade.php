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
<?php 
	if(isset($result))
	{ ?>
		<tbody>
		<?php $i = 1; ?>
		@foreach($result as $value)
		<tr>
			<th scope="row">{{$i++}}</th>
			<td>{{$value->get_fb_city_from['city_name']}}</td>
			<td>{{$value->get_fb_city_to['city_name']}}</td>
			<td>{{date('Y/m/d H:i:s',mktime(0,0,$value['fb_departure_date']))}}</td>
			<td><a href="{{Route('details', $value['fb_id'])}}">Xem <i class="fas fa-forward"></i></a></td>
			<td>{{$value->get_fb_user['email']}}</td>
			<td>{{$value->get_fb_user['phone']}}</td>
			<td>Delete</td>
		</tr>
		@endforeach
		</tbody>
<?php	} else {
	?> 

	<script type="text/javascript">

		alert("Không tìm thấy user");

</script>


	<?php
}
 ?>

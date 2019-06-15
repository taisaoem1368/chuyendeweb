

<thead>
	<tr>
		<th>#</th>
		<th>Airline Name</th>
		<th>Airline Code</th>
		<th>Country</th>
	</tr>
</thead>
@if(count($airlines) > 0)

<tbody >
	<?php $i = 1; ?>
	@foreach($airlines as $value)
	<tr>
		<th scope="row"><?php echo $i++;  ?></th>
		<td>{{$value['airline_name']}}</td>
		<td>{{$value['airline_code']}}</td>
		<td>{{$value->get_country['country_name']}}</td>
	</tr>
	@endforeach
</tbody>
@endif


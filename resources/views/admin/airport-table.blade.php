<thead>
	<tr>
		<th>#</th>
		<th>Airport Name</th>
		<th>City Name</th>
		<th>Country</th>
	</tr>
</thead>
@if(count($airports) > 0)
<tbody id="tbody-airports">
	<?php $i = 1; ?>
	@foreach($airports as $value)
	<tr>
		<th scope="row"><?php echo $i++;  ?></th>
		<td>{{$value['airport_name']}}</td>
		<td>{{$value->get_cities['city_name']}}</td>
		<td><?php echo $value->get_Country_name($value->get_cities['cities_country_id']); ?></td>
	</tr>
	@endforeach
</tbody>
@endif
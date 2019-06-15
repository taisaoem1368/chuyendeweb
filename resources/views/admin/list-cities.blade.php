<!--Citis-->
@if(isset($cities_list))
<option disabled="disabled" selected="true">Thành Phố</option>
@foreach($cities_list as $value)
<option value="{{$value['city_id']}}">{{$value['city_name']}}</option>
@endforeach
@endif

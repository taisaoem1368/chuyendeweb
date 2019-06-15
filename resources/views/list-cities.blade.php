<!--Citis-->
@if(isset($cities_list))
<option value="" disabled="disabled" selected="selected">Choose a city</option>
@foreach($cities_list as $value)
<option value="{{$value['city_id']}}">{{$value['city_name']}}</option>
@endforeach
<?php unset($cities_list);?>
@endif

<option value="" disabled="disabled" selected="true">Chọn Thành Phố</option>
@if($kieu == "world")
@foreach($cities_connect as $value)
<option value="{{$value['city_id']}}">{{$value['city_name']}}</option>
@endforeach
@endif
@foreach($cities_country_select as $value)
<option value="{{$value['city_id']}}">{{$value['city_name']}}</option>
@endforeach
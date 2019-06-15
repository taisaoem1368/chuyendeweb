<!--Airlines-->
@if(isset($airlines))
@foreach($airlines as $value)
<option value="{{$value['airline_id']}}">{{$value['airline_name']}}</option>
@endforeach
<?php unset($airlines);?>
@endif

<!--Citis-->
@if(isset($cities))
@foreach($cities as $value)
<option value="{{$value['city_id']}}">{{$value['city_name']}}</option>
@endforeach
<?php unset($cities);?>
@endif
<!--Airport-->

@if(isset($airports))
@foreach($airports as $value)
<option value="{{$value['airport_id']}}">{{$value['airport_name']}}</option>
@endforeach
<?php unset($airports);?>
@endif
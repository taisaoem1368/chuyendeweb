
<!--Airport-->

@if(count($airports) > 0)
<option value="" disabled="disabled" selected="selected">Choose a airport</option>
@foreach($airports as $value)
<option value="{{$value['airport_id']}}">{{$value['airport_name']}}</option>
@endforeach
<?php unset($airports);?>
@else
<option disabled="disabled">Không tìm thấy sân bay</option>
@endif
<!--Airlines-->
@if(count($airlines) > 0)
<option value="" disabled="disabled" selected="selected">Choose a airline</option>
@foreach($airlines as $value)
<option value="{{$value['airline_id']}}">{{$value['airline_name']}}</option>
@endforeach
<?php unset($airlines);?>
@else
<option disabled="disabled">Không tìm thấy hãng bay</option>
@endif

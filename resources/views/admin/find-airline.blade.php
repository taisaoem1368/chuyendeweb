<option value="" selected disabled="disabled">Choose Airline</option>
@foreach($kqFlight as $value)
<option value="{{$value['airline_id']}}">{{$value['airline_name']}}</option>
@endforeach
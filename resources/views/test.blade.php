<?php if(isset($country_list))
		{
			echo "ab";
		}
 ?>

 @foreach($country_list as $v)
 	<option>{{$v['country_id']}}</option>
 @endforeach
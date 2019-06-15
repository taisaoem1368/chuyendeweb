<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
@extends('master')
@section('content')
<style type="text/css">
    .controls {
        border-bottom: 1px solid #eee;

    }
    .form-control {
        border: 1px solid #eee;
    }   
</style>
<main>
    <div class="container">
        <h3>Filght: </h3>

        <form class="form-horizontal">
            <div class="form-group controls">
                <label class="control-label col-xs-2">Country: </label>
                <div class="col-xs-10">
                    <select name="country" id="country">
                        <option disabled="disabled" selected="selected">Choose a country</option>
                        @foreach($country as $value)
                        <option value="{{$value['country_id']}}">{{$value['country_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group controls">
                <label class="control-label col-xs-2">Airlines: </label>
                <div class="col-xs-10">
                    <select name="airline" id="airlines">
                        <option value="" disabled="disabled" selected="selected">Choose a airline</option>
                    </select>
                </div>
            </div>
            <div class="form-group controls">
                <label class="control-label col-xs-2">Cities: </label>
                <div class="col-xs-10">
                    <select name="cities" id="cities">
                        <option value="" disabled="disabled" selected="selected">Choose a city</option>
                    </select>
                </div>
            </div>
            <div class="form-group controls">
                <label class="control-label col-xs-2">Airports: </label>
                <div class="col-xs-10">
                    <select name="airports" id="airports">
                        <option value="" disabled="disabled" selected="selected">Choose a airport</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
<script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').change(function(){
            var id = $('#country').val();
            $('#airlines').load('country/'+id);
            //$('#cities').load('country-city/'+id);
        });

        $('#airlines').change(function() {
            var id = $('#airlines').val();
            $('#cities').load('airline/'+id);
        });

        $('#cities').change(function() {
            var id = $('#cities').val();
            $('#airports').load('city/'+id);
        });
    });
</script>
@extends('master')
@section('title')
    Flight Search
@endsection
@section('content')
    <main>
        <div class="container">
            
            <section>
                <?php if (empty($return) || $flight_type == 'one-way'): ?>
                    <?php $tail = ''; ?>
                    <h2><?php echo $airport_from['airport_name']." "."( ".$airport_from['airport_code']." )" ?>
                        <i class="glyphicon glyphicon-arrow-right"></i>
                            <?php echo $airport_to['airport_name']." "."( ".$airport_to['airport_code']." )" ?>
                    </h2>
                <?php else: ?>
                    <?php $tail = '_re'; ?>
                    <h2><?php echo $airport_to['airport_name']." "."( ".$airport_from['airport_code']." )" ?>
                        <i class="glyphicon glyphicon-arrow-right"></i>
                            <?php echo $airport_from['airport_name']." "."( ".$airport_to['airport_code']." )" ?>
                    </h2>
                <?php endif; ?>
                @foreach ($flight_found as $fl)
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="detail<?php echo $fl['flight_id']?>" action='{{route('detail')}}' method='get'>
                                        <input type='hidden' name='from'   value="<?php echo $fl['flight_from_id']?>">
                                        <input type='hidden' name='to'     value="<?php echo $fl['flight_to_id']?>">
                                        <input type='hidden' name='id'     value="<?php echo $fl['flight_id']?>">
                                        <input type='hidden' name='person' value="<?php echo $person?>">
                                    </form>
                                    
                                    <?php 
                                        if (!empty($return) || $flight_type == 'one-way') 
                                        {   $route =  'book';}
                                        else 
                                        {   $route =  'search_return';}
                                    ?>
                                    <form id="form<?php echo $fl['flight_id'] ?>" action='{{route($route)}}' method='get'>
                                        <?php if (!empty($flight)) :?>
                                        <input type="" name="flight" value="<?php echo $flight ?>">
                                        <?php endif; ?>
                                        <input type='hidden' name='flight<?php echo $tail ?>' value='<?php echo $fl?>'>
                                        <input type='hidden' name='to'   value="<?php echo $fl['flight_from_id']?>">
                                        <input type='hidden' name='form'     value="<?php echo $fl['flight_to_id']?>">
                                        <input type='hidden' name='person' value='<?php echo $person?>'>
                                    </form>
                                    <h4><strong><a href="#" onclick="document.getElementById('detail<?php echo $fl['flight_id']?>').submit();"><?php echo $fl['flight_airline']?></a></strong></h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time"><?php echo $fl['flight_from_time']?></big></div>
                                            <div><span class="place"><?php echo $airport_from['airport_name']." "."( ".$airport_from['airport_code']." )" ?></span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time"><?php echo $fl['flight_to_time']?></big></div>
                                            <div><span class="place"><?php echo $airport_to['airport_name']." "."( ".$airport_to['airport_code']." )" ?></span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <?php $duration = strtotime($fl['flight_to_time']) - strtotime($fl['flight_from_time']) ?>
                                            <label class="control-label">Duration:</label>
                                            <div><big class="time"><?php echo date('H:i:s',$duration) ?></big></div>
                                            <div><strong class="text-danger">1 Transit</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong>USD<?php echo $fl['flight_price']?></strong></h3>
                                            <div>   
                                                <a href="#" class="btn btn-link" onclick="$('#detail<?php echo $fl['flight_id']?>').submit();">See Detail</a>
                                                <a href="#" class="btn btn-primary" onclick="$('#form<?php echo $fl['flight_id']?>').submit();">Choose</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">&lsaquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&rsaquo;</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </section>
                
        </div>
    </main>
@endsection
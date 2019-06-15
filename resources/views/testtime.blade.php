<?php 
//  date_default_timezone_set('Asia/Ho_Chi_Minh');
// /*
// $a = mktime(12,00,00);
// $b = mktime(13,00,00);
// $k = strtotime(date('H:i:s', $a));
// echo $k."<br>";
// echo date('H:i:s', $a);
// */
// $a = date('Y-m-d H:i:s');


// $b = date('2019-03-06 12:00:00');

// $c = date('2019-03-06 13:30:00');

// $g = strtotime($b);
// $h = strtotime($c);

// $k = $h - $g;

// echo $k/3600;
// echo date('H:i', mktime(0,0,5400));
$url = 'https://api.coinmarketcap.com/v1/ticker/';
$data = file_get_contents($url);

			 /* Decode JSON array. */
$flight = json_decode($data);
var_dump($flight);
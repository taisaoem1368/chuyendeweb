<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<?php

namespace App;
class TinhGiaVe {


	public function __construct($km, $date_booking, $boolean)// int - int - int - boolean
	{
		$distance = $this->distance($km);
		$time_booking = $this->time_booking(strtotime(date('Y/m/d' 'H:i:s')), $date_booking);
		$suddenly = $this->suddenly($boolean);

		$total = $distance*$time_booking*$suddenly;

		return $total;
	}

	//tạo chuyến bay đột ngột trước 3 tháng
	public function suddenly($boolean)
	{
		if($boolean == true)// đúng tăng lên 5% so với giá đơn vị
		{
			return 1.05;
		}
		return 1;
	}

	//time booking Thời gian truyền vào là số nguyên - giờ Việt Nam
	public function time_booking($date_now, $date_booking)
	{
		$time = $date_booking - $date_now;
		$day = date('d', $time);
		$month = date('m', $time);
		if($month == 0)
		{
			if($day == 1) // ngày = 1 tăng 50%
			{
				return 1.5;
			}
			else if ($day <= 7) // ngày <= 7 tăng 20%
			{
				return 1.2;
			}
			else if ($day <= 14) // ngày <= 14 tăng 10%
			{
				return 1.1;
			}
			else // > 14 ngày giảm 5%
			{
				return 0.95;
			}
		} else // tháng khác 0
		{
			if($month < 2) // nhỏ hơn 2 tháng giảm 5%
			{
				return 0.95;
			}
			else // lớn hơn or bằng 2 tháng giảm 10%
			{
				return 0.9; 
			}
		}

	}


	//tính quảng đường theo ki lô mét
	public function distance($km)
	{
		if ($km <= 100)
		{
			return 500000;
		}
		else if ($km <= 200)
		{
			return 1000000;
		}
		else if ($km <=500)
		{
			return 2000000;
		}
		else if ($km <= 1000)
		{
			return 3000000;
		}
		else if ($km <= 2000)
		{
			return 6000000;
		}
		else if ($km <= 5000)
		{
			return 20000000;
		}
		else
		{
			return 30000000;
		}
	}

}
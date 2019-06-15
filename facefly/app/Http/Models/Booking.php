<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Booking extends Model{
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    
    public function G_booking_all(){
        $data = $this->all();
        return $data;
    }
    
    public function G_booking_id($id){
        $data = $this->find($id);
        return $data;
    }
    
    public function U_booking($data){
        $book_obj = new Booking();

        $book_obj->booking_user_id =        $data['user_id'];
        $book_obj->booking_passengers =     $data['passengers'];
        $book_obj->booking_method =         $data['method'];
        $book_obj->booking_credit_number =  $data['credit_number'];
        $book_obj->booking_credit_name =    $data['credit_name'];
        $book_obj->booking_credit_cvv =     $data['credit_cvv'];
        $book_obj->booking_price =          $data['price'];
        $book_obj->save();
    }
    
}
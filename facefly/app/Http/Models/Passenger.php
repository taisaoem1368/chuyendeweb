<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Passenger extends Model{
    protected $table = 'passenger';
    protected $primaryKey = 'passenger_id';
    
    public function G_passenger_all(){
        $data = $this->all();
        return $data;
    }
    
    public function G_passenger_id($id){
        $data = $this->find($id);
        return $data;
    }
    
    public function U_passenger($data){
              
        $pas_obj = new Passenger();
        $pas_obj->passenger_user_id =   $data['user_id'];
        $pas_obj->passenger_title =     $data['passenger_title'];
        $pas_obj->passenger_firstname = $data['passenger_firstname'];
        $pas_obj->passenger_lastname =  $data['passenger_lastname'];
        
        $pas_obj->save();
        
    }
}
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model{
    protected $table = 'flight';
    protected $primaryKey = 'flight_id';
    
    public function G_flight_all(){
        $data = $this->all();
    }
    
    public function G_flight_id($id){
        $data = $this->where('flight_id',$id)->get();
        return $data[0];
    }
    
    public function G_flight_from_to($from,$to){
        $data = $this->leftjoin('airport', 'airport.airport_id','=','flight.flight_from_id')
                ->where('flight_from_id',$from)->where('flight_to_id',$to)->get();
        return $data;
    }
    
    
    
}


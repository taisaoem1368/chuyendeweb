<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Airline extends Model{
    protected $table = 'airline';
    protected $primaryKey = 'airline_id';
    
    public function G_airline_all(){
        $data = $this->all();
        return $data;
    }
    
    public function G_airline_id($id){
        $data = $this->find($id);
        return $data;
    }
    
}
<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Airport extends Model{
    protected $table = 'airport';
    protected $primaryKey = 'airport_id';
    
    public function G_airport_all(){
        $data = $this->all();
        return $data;
    }
    
    public function G_airport_id($id){
        $data = $this->find($id);
        return $data;
    }
    
}
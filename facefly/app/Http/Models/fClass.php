<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class fClass extends Model{
    protected $table = 'class';
    protected $primaryKey = 'class_id';
    
    public function G_class_all(){
        $data = $this->all();
        return $data;
    }
    
    public function G_class_id($id){
        $data = $this->find($id);
        return $data;
    }
    
}
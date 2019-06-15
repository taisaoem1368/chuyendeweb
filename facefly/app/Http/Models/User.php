<?php
namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];   
    
    public function U_user($req){
        $user_obj = new User();
        $user_obj->email = $req['user_email'];
        $user_obj->password = Hash::make($req['user_pass']);
        $user_obj->name = $req['user_name'];
        $user_obj->user_phone = $req['user_phone'];
        $user_obj->user_payment_method = $req['user_payment_method'];
        $user_obj->user_credit_number = $req['user_credit_number'];
        $user_obj->user_credit_name = $req['user_credit_name'];
        $user_obj->user_credit_cvv = $req['user_credit_cvv'];
        $user_obj->save();
        
    }
    
}


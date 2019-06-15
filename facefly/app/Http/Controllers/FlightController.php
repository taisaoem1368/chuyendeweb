<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Airport;
use App\Http\Models\Flight;
use App\Http\Models\fClass;
use App\Http\Models\Airline;
use App\Http\Models\Passenger;

class FlightController extends Controller{
    
     public function __construct()
    {
//        $this->middleware('auth');
    }
    
    public function index(){
        $airport_obj = new Airport();
        $fclass_obj = new fClass();
        $data = $airport_obj->G_airport_all();
        $data2 = $fclass_obj->G_class_all();
        return view('template.index',['airport_list'=>$data,'class_list'=>$data2]);
    }
    
    public function detail(){
        
        return view('template.flight-detail');
    }
    
    public function book(){
        
        return view('template.flight-book');
    }
    
    public function idFlight($id){
        $f_obj= new Flight();
        $data = $f_obj->G_flight_id($id);
        return $data;
    }
    
    public function Search(Request $req){
        $from = $req->from;
        $to = $req->to;
        $flight_type = $req->flight_type;
        $date_departure = $req->date_departure;
        $flight_class = $req->flight_class;
        
        var_dump($req->flight);
        
        if ($from == $to){
            return redirect ()->back ()->with('error1','Điểm đi và đến không thể trùng nhau');}
        
        $time_de =  strtotime($date_departure) - strtotime(date('Y-m-d'));
        if ($time_de < 0){
            return redirect ()->back ()->with('error2','Không thể chọn thời gian bay trong quá khứ');}  
        
        if ($flight_type == 'return')
        {
            $date_return = $req->date_return;
            $time_re =  strtotime($date_return) - strtotime(date('Y-m-d'));
            if ($time_re < 0){
                return redirect ()->back ()->with('error2','Không thể chọn thời gian bay trong quá khứ');} 
        }    
        $person = $req->person;
        
        $flight_obj = new Flight();
        $airport_obj = new Airport();
        
        $data_airport_from = $airport_obj->G_airport_id($from);
        $data_airport_to = $airport_obj->G_airport_id($to);
        
        
        $data_flight = $flight_obj->G_flight_from_to($from, $to);
        
        for ($i=0; $i< sizeof($data_flight); $i++)
        {
            $fclass_obj = new fClass();
            $class_name = $fclass_obj->G_class_id($data_flight[$i]['flight_class_id']);
            $data_flight[$i]['flight_class'] = $class_name['class_name'];
        
            $airline_obj = new Airline();
            $airline_name = $airline_obj->G_airline_id($data_flight[$i]['flight_airline_id']);
            $data_flight[$i]['flight_airline'] = $airline_name['airline_name'];
        }
        
        if (!empty($req->flight))
        {
            $flight = $req->flight;
            return view('template.flight-list',[
                'flight_found'=>$data_flight,
                'airport_from'=>$data_airport_from,
                'airport_to'=>$data_airport_to,
                'flight_type'=>$flight_type,
                'person'=>$person,
                'flight'=>$flight,
                'return'=>'return'
                ]);
        }
        else
        {
            return view('template.flight-list',[
                'flight_found'=>$data_flight,
                'airport_from'=>$data_airport_from,
                'airport_to'=>$data_airport_to,
                'flight_type'=>$flight_type,
                'person'=>$person]);
        }

    }
    
    public function detailFlight(Request $req){
        $id= $req->id;
        $id = $id + 0;
        
              
        $person = $req->person;
        $from = $req->from;
        $to = $req->to;
        
        
        $flight_obj = new Flight();
        $airport_obj = new Airport();
        
        $data_airport_from = $airport_obj->G_airport_id($from);
        $data_airport_to = $airport_obj->G_airport_id($to);
        
                       
        $data_flight = $this->idFlight($id);
        
                        
        return view('template.flight-detail',['flight'=>$data_flight,'airport_from'=>$data_airport_from,'airport_to'=>$data_airport_to, 'person'=>$person]);
    }
    
    public function getBooking(request $req){
        $flight= (array) json_decode($req->flight);
        
        $person= $req->person;
//        var_dump($req->flight);
//        var_dump(json_decode($req->flight));
//        var_dump((array) $flight);
//        die();
        $from = $flight['flight_from_id'];
        $to = $flight['flight_to_id'];
        
        $airport_obj = new Airport();
        
        $data_airport_from = $airport_obj->G_airport_id($from);
        $data_airport_to = $airport_obj->G_airport_id($to);
        
//        if (Auth::check)
//        {
            return view('template.flight-book',['flight'=>$flight,'airport_from'=>$data_airport_from,'airport_to'=>$data_airport_to, 'person'=>$person]);
//        }
    }
    
    public function postBooking(request $req){
        
        $passengers = $req->passengers;
        $passe_obj = new Passenger();
        foreach ($passengers as $passe)
        {
            $passe_obj->U_passenger($passe);
        }
        
        
        $person = $req->person;
        
        
    }
}

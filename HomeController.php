<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusSeat;
use App\Models\Parking;
use App\Models\SeatBooking;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    //
    public function home()
    {
        $next_parking_slot= DB::table('users')->count();


        $next_parking_slot =str_pad($next_parking_slot + 1, 5, '0', STR_PAD_LEFT);

        return view('home',compact('next_parking_slot'));

    }



    public function print_receipt_save()
    {
        $parking = new Parking() ;
        $parking->company_name = $_POST['company_name'];
        $parking->address =$_POST['address'];
        $parking->date =date('Y-m-d',strtotime($_POST['date']));
        $parking->time =$_POST['time'];
        $parking->space =$_POST['space'];
        $parking->price =$_POST['price'];
        $parking->save();
        $id=$parking->id;

        $parking=Parking::where('id', $id)->first();

        return view('parking_print',compact('parking'));
    }




}

<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function allReservationEP(){

        $reservation = reservation::orderBy('date','desc')->orderBy('time','asc')->get();
        return $reservation;
    }
    public function fetchAllData(){
        return view("data");
    }
}

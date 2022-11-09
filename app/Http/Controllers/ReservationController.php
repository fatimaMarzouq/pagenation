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
    public function deleteData($id){
        $row = reservation::find($id);
        $row->delete();
        return 1;
    }
    public function updatePostData($request){
        // (`id`, `status`, `bookingID`, `bookingID2`, `sender`, `sender2`, `title`, `language`, `date`, `time`, `name`, `surname`, `adults`, `children`, `toddlers`, `email`, `phone`, `price`, `price2`, `added`
        $data = $request->all();
        $row = reservation::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return 1;
    }
}

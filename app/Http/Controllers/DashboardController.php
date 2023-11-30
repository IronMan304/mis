<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $time = Carbon::now()->format('H');
        //$appointments = Appointment::all();
        //$patients = Patient::all();
        //$billings = Billing::whereIn('status_id', [5,6])->get();
        //$ops = BookingServiceKey::all();
        //$operations = 0;
        // foreach($ops as $op)
        // {
        //     if($op->date_start != null){
        //         $operations += 1;
        //     }
        // }
        // $earnings = 0;
        // foreach($billings as $bill)
        // {
        //     $earnings += $bill->paid_amt;
        // }

        return view('dashboard', [
            'time' => $time,
            // 'appointments' => $appointments,
            // 'patients' => $patients,
            // 'earnings' => $earnings,
            // 'operations' => $operations
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomHelper;

class ReportController extends Controller
{
    /**
     * Add New User
     * @param Request $request
     */
    public function monthlyProductionReport(Request $request)
    {
        $result = CustomHelper::select_producer_measurement($request->start_date, $request->end_date);
        dd($result);
        return collect([
//            'code' => '500',
//            'message'=> "Receiving data is not JSON format",
        ]);

        // CustomHelper::save_new_user($request->name, $request->email, $request->pwd, $request->role, $request->facil);
        // return view('dashboard/monthlyreport');
        // return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }

    public function monthlyMonitoringReport(Request $request)
    {
        // CustomHelper::save_new_user($request->name, $request->email, $request->pwd, $request->role, $request->facil);
        // return view('dashboard/monthlyreport');
        // return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }
}

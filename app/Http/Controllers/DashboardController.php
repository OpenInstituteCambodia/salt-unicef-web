<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\CustomHelper;
use Auth;

class DashboardController extends Controller
{
    // Current Display user mgmt view
    function index()
    {
        if(Auth::user()->role==1)
        {
            $result = CustomHelper::list_all_users();
            // For display list of facilities in select options
            $result_facility = CustomHelper::list_all_facilities();
            return view('dashboard/usermgmt',['all_users' => $result, 'facilities' => $result_facility]);
        }
        else{
            return view('dashboard/monitor');
        }
    }

    // Display user mgmt view
    function userManagement()
    {
        if(Auth::user()->role==1) {
            $result = CustomHelper::list_all_users();
            $result_facility = CustomHelper::list_all_facilities();
            return view('dashboard/usermgmt', ['all_users' => $result, 'facilities' => $result_facility]);
        }
    }

    // Display facility mgmt view
    public function facilityManagement()
    {
        if(Auth::user()->role==1) {
            $fac_result = CustomHelper::list_all_facilities();
            return view('dashboard/facilitymgmt', ['all_facilities' => $fac_result]);
        }
    }

    // Display monthly report view
    public function monthlyProductionReportView()
    {
        if(Auth::user()->role==1) {
//        $fac_result = CustomHelper::list_all_facilities();
            return view('dashboard/producing_monthly_report');
//        return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
        }
    }
    // Display monthly report view
    public function monthlyMonitoringReportView()
    {
        if(Auth::user()->role==1) {
//        $fac_result = CustomHelper::list_all_facilities();
            return view('dashboard/monitoring_monthly_report');
//        return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
        }
    }

    // return to login if URL=localhost/
    public function gotoLogin(){
        return Redirect::route('login');
    }

}

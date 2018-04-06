<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\CustomHelper;

class DashboardController extends Controller
{
    // Current Display user mgmt view
    function index()
    {
        $result = CustomHelper::list_all_users();
        // For display list of facilities in select options
        $result_facility = CustomHelper::list_all_facilities();
        return view('dashboard/usermgmt',['all_users' => $result, 'facilities' => $result_facility]);
    }

    // Display user mgmt view
    function userManagement()
    {
        $result = CustomHelper::list_all_users();
        $result_facility = CustomHelper::list_all_facilities();
        return view('dashboard/usermgmt',['all_users' => $result, 'facilities' => $result_facility]);
    }

    // Display facility mgmt view
    public function facilityManagement()
    {
        $fac_result = CustomHelper::list_all_facilities();
        return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }

    // Display monthly report view
    public function monthlyProductionReportView()
    {
//        $fac_result = CustomHelper::list_all_facilities();
        return view('dashboard/producing_monthly_report');
//        return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }
    // Display monthly report view
    public function monthlyMonitoringReportView()
    {
//        $fac_result = CustomHelper::list_all_facilities();
        return view('dashboard/monitoring_monthly_report');
//        return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }



    /**
     * Change Language Locale when flag icon is clicked
     */
//    public function changeLanguage(Request $request)
//    {
//        echo App::getLocale();
//        $a = Session::put('locale', $request->flag_icon);
//        $b = App::setLocale($request->flag_icon);
//        dd($b);
//
//        return Redirect::back();
//    }

}

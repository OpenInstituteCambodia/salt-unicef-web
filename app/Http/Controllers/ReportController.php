<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomHelper;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Add New User
     * @param Request $request
     */
    public function monthlyProductionReport(Request $request)
    {
        $from = Carbon::parse($request->start_date);
        $to = Carbon::parse($request->end_date);
        $number_of_days = $from->diffInDays($to);
        $producer_result = CustomHelper::select_producer_measurement($request->start_date, $request->end_date, $number_of_days);
        $i=0;
        $all_arr = array();
        if(!empty($producer_result))
        {
            foreach($producer_result as $producer_each_result)
            {
                $i=$i+1;
                // each array of a record
                $arr_each= array(
                    "No" => $i,
                    "facility_name"=>$producer_each_result->facility_name,
                    'iodized_salt_produced'=>$producer_each_result->total_salt_produced,
                    'potassium_used'=>$producer_each_result->total_potassium_produced,
                    'percentage_of_days_producing_per_standard'=>$producer_each_result->percentage_days,
                    'radio_iodized_salt_produced_over_potassium_used'=>$producer_each_result->ratio_iodized_over_potassium
                );
                // push each array of a record into all_array
                array_push($all_arr, $arr_each);
            } // ./foreach($monitor_result)
        } // . if(!empty($monitor_result))

        return array("data" => $all_arr);
    }

    public function monthlyMonitoringReport(Request $request)
    {
        $monitor_result = CustomHelper::select_monitor_measurement($request->start_date, $request->end_date);
        $i=0;
        $all_arr = array();
        if(!empty($monitor_result))
        {
            foreach($monitor_result as $each_result)
            {
                $i=$i+1;
                // each array of a record
                $arr_each= array(
                    "No" => $i,
                    "facility_name"=>$each_result->facility_name,
                    'number_inspection'=>$each_result->num_inspections,
                    'percentage_of_samples_per_standard'=>$each_result->percentage_samples,
                    'total_warning'=>$each_result->total_warning
                );
                // push each array of a record into all_array
                array_push($all_arr, $arr_each);
            } // ./foreach($monitor_result)
        } // . if(!empty($monitor_result))

        return array("data" => $all_arr);
    }
}

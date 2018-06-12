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
                    'total_number_days' => $number_of_days,
                    'percentage_of_days_producing_0_15ppm'=>$producer_each_result->percentage_days_0_15ppm,
                    'percentage_of_days_producing_15_30ppm'=>$producer_each_result->percentage_days_15_30ppm,
                    'percentage_of_days_producing_30_50ppm'=>$producer_each_result->percentage_days_30_50ppm,
                    'percentage_of_days_producing_50_60ppm'=>$producer_each_result->percentage_days_50_60ppm,
                    'percentage_of_days_producing_over_60ppm'=>$producer_each_result->percentage_days_over_60ppm,
                    'ratio_iodized_salt_produced_over_potassium_used'=>$producer_each_result->ratio_iodized_over_potassium
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
                    'percentage_of_samples_0_15ppm'=>$each_result->percentage_0_15,
                    'percentage_of_samples_15_30ppm'=>$each_result->percentage_15_30,
                    'percentage_of_samples_30_60ppm'=>$each_result->percentage_30_60,
                    'percentage_of_samples_over_60ppm'=>$each_result->percentage_over_60,
                    'total_warning'=>$each_result->total_warning
                );
                // push each array of a record into all_array
                array_push($all_arr, $arr_each);
            } // ./foreach($monitor_result)
        } // . if(!empty($monitor_result))

        return array("data" => $all_arr);
    }
}

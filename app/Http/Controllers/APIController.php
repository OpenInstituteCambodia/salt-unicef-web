<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomHelper;
use App\Http\Resources\UserRoleResource;
use DB;
use Illuminate\Support\Facades\Log;
use App\Facility;

class APIController extends Controller
{
    public function UserRoleApp(Request $request)
    {
        // info($request->toArray());
        // info($request->getContentType());
        $check_result = CustomHelper::user_role_app($request->email, $request->pwd);
        return $check_result;

        // == not used ==  Pass data into userRole Resource (API) and the API will return data in JSON format
        // return new UserRoleResource($check_result);
    }

    /**
     * @param Request $request // is the json post data
     * @return \Illuminate\Support\Collection
     * Logic
     * Foreach of json element
     *  If the data of the json array are successfully inserted then commit those data into DB
     *      @return {code=200, message='ok'}
     *  Else rollback all the inserted data @return {code=500, message=error_message}
     * End foreach
     */
    /**
     * Example of json data
        [
            {
                "producers" : [
                    {"measurement_1":"20","measurement_2":"30"},
                    {"measurement_1":"10","measurement_2":"20"}
                ]
            },
            {
                "monitors" : [
                    {"measurement":"20","warning" :"0"},
                    {"measurement":"10","warning" :"1"}
                ]
            }
        ]
        $request->toArray() // Converting JSON to Array
     */

    public function SyncDataFromApp(Request $request)
    {
        // info($request->toArray());
        // info($request->getContentType());
        DB::beginTransaction();
        if($request->getContentType() == 'json')
        {
            try{
                foreach ($request->toArray() as $key1 => $val1)
                {
                    // dd($key1) =0, dd($val1) = array of elements
                    foreach ($val1 as $key2 => $val2)
                    {
                        // dd($key2)="producers" [table_name]; dd($val2) get array of table_inserted value
                        foreach ($val2 as $data)
                        {
                            $data['created_at']=date('Y-m-d H:i:s');
                            $data['updated_at']=date('Y-m-d H:i:s');
                            DB::table($key2)->insert($data);
                        }
                    }
                }
                DB::commit();
                return collect([
                    'code' => '200',
                    'message'=> "Ok"
                ]);
            }
            catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return collect([
                    'code' => '500',
                    'message'=> $e->getMessage(),
                ]);
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return collect([
                    'code' => '500',
                    'message'=> $e->getMessage(),
                ]);
            }
        }
        else
        {
            return collect([
                'code' => '500',
                'message'=> "Receiving data is not JSON format",
            ]);
        }
    }

    public function ListFacilitiesForApp(){
        $all_facilities = Facility::select('id','facility_ref_id', 'facility_name')->get();
        return collect([
            //'message'=> 'Ok',
            'facilities'=> $all_facilities,
        ]);
    }

    /**
     * API to get List of updated records in Tbl facilities
     * @param Request $request
     * @return Collection of records
     */

    public function GetListOfUpdatedFacilities(Request $request){
        if($request->getContentType() == 'json') {
            if(!empty($request->number_of_records) || !empty($request->last_download_date))
            {
                return CustomHelper::get_facility_list($request->number_of_records,
                    $request->last_download_date);
            }
            else{
                return collect([
                    'code' => '500',
                    'message'=> "Either Number of records or Last download date is null. Those fields are required.",
                ]);
            }
        }
        else {
            return collect([
                'code' => '500',
                'message'=> "Receiving data is not JSON format",
            ]);
        }
    }
}

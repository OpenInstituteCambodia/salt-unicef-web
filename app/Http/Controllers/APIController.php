<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomHelper;
use App\Http\Resources\UserRoleResource;
use DB;

class APIController extends Controller
{
    public function UserRoleApp(Request $request)
    {
        $check_result = CustomHelper::user_role_app($request->email, $request->pwd);
        // Pass data into userRole Resource (API) and the API will return data in JSON format
        return new UserRoleResource($check_result);
    }

    public function SyncDataFromApp(Request $request)
    {
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

         * $request->toArray() // Converting JSON to Array

         */

        DB::beginTransaction();
        try{
            foreach ($request->toArray() as $key1 => $val1)
            {
                // dd($key1) =0, dd($val1) = array of elements
                foreach ($val1 as $key2 => $val2)
                {
                    // dd($key2)="producers" [table_name]; dd($val2) get array of table_inserted value
                    foreach ($val2 as $data)
                    {
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
//        catch (ValidationException $e)
//        {
//            DB::rollBack();
//            return collect([
//                'message'=> $e->getMessage(),
//            ]);
//        }
        catch (\Illuminate\Database\QueryException $e) {
            // something went wrong with the transaction, rollback
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomHelper;
use App\Http\Resources\UserRoleResource;

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
        // Goal to insert data into DB

        dd ($request);



        // API will inserted status back to mobile app in JSON format
        //return new UserRoleResource($update_status);
    }
}

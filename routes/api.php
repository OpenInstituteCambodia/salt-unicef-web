<?php

use Illuminate\Http\Request;
use App\CustomHelper;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user_role_app', 'APIController@UserRoleApp');
Route::post('/sync_data_app', 'APIController@SyncDataFromApp');
Route::get('/list_facilities_app', 'APIController@ListFacilitiesForApp');
Route::post('/get_updated_facility_lists_app', 'APIController@GetListOfUpdatedFacilities');
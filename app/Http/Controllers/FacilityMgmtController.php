<?php

namespace App\Http\Controllers;

use App\Facility;
use Illuminate\Http\Request;
use App\CustomHelper;

class FacilityMgmtController extends Controller
{
    /**
     * Add New Facility
     * @param Request $request
     */
    public function addNewFacility(Request $request)
    {
        CustomHelper::save_new_facility($request->faciRef, $request->faciName, $request->faciLat, $request->faciLong);
    }

    /**
     * Softdelete Facility
     * @param Request $request
     */
    public function softDeleteFacility(Request $request)
    {
        $delete_facility = Facility::where('id', '=', $request->delete_val)->first();
        $delete_facility->delete();
        //return $delete_facility->id;
    }

    /**
     * Display Existing Facility data for Editing
     * @param Request $request
     * @return string
     */
    public function displayFacilityInfoById(Request $request)
    {
        $faci_info = CustomHelper::faci_info_by_ID($request->id);
        // Data to be displayed in body and footer of modal
        $faci_data = "<div class='modal-body'>"
                        . "<div class='form-group'>"
                            . "<label for='edit_faci_ref_id' class='col-md-6'>"
                                . trans('allstr.facility_ref_id')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<input id='edit_faci_ref_id' type='text' class='form-control' name='edit_faci_ref_id' value='" . $faci_info->facility_ref_id . "'>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"

                        . "<div class='form-group'>"
                            . "<label for='edit_faci_name' class='col-md-6'>"
                                . trans('allstr.name')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<input id='edit_faci_name' type='text' class='form-control' name='edit_faci_name' value='" . $faci_info->facility_name . "'>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"

                        . "<div class='form-group'>"
                            . "<label for='edit_faci_lat' class='col-md-6'>"
                                . trans('allstr.lat')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<input id='edit_faci_lat' type='text' class='form-control' name='edit_faci_lat' value='" . $faci_info-> Latitude . "'>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"


                        . "<div class='form-group'>"
                            . "<label for='edit_faci_long' class='col-md-6'>"
                                . trans('allstr.long')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<input id='edit_faci_long' type='text' class='form-control' name='edit_faci_long' value='" . $faci_info->Longitude . "'>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"

                    . "</div>"
                    . "<div class='modal-footer'>"
                        . "<button class='btn btn-outline-danger' data-dismiss='modal'>
                            <i class='fa fa-refresh fa-lg' aria-hidden='true'></i> "
                            . trans('allstr.cancel')
                        ."</button>"
                        . "<button class='btn btn-outline-primary' data-dismiss='modal' id='save_faci_btn' name='". $faci_info->id ."'>
                            <i class='fa fa-floppy-o fa-lg' aria-hidden='true'></i> "
                            . trans('allstr.save')
                        ."</button>"
                    . "</div>"
                    ;
        return $faci_data;
    }

    /**
     * Save Editing Data
     * @param Request $request
     */
    public function saveEditFacilityData(Request $request)
    {
        CustomHelper::update_facility($request->faciRef, $request->faciName, $request->faciLat, $request->faciLong, $request->fid);
    }
}

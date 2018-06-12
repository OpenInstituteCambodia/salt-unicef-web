<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\CustomHelper;
use App\User;
use App\Facility;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

class UserMgmtController extends Controller
{
    /**
     * Add New User
     * @param Request $request
     */
    public function addNewUser(Request $request)
    {
        logger('AA');
        CustomHelper::save_new_user($request->name, $request->email, $request->pwd, $request->role, $request->facil);
        // return view('dashboard/monthlyreport');
        // return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }

    /**
     * Softdelete user
     * @param Request $request
     */
    public function softDeleteUser(Request $request)
    {
        $delete_user = User::where('id', '=', $request->delete_val)->first();
        $delete_user->delete();
        echo $delete_user->id;
        //return $delete_user->id;
    }

    /**
     * Log out
     * @return redirected to login page
     */
    public function logOut()
    {
        Auth::logout();
        return redirect('/login');
    }

    /**
     * Display Existing user data for Editing
     * @param Request $request
     * @return string
     */
    public function displayUserInfoById(Request $request)
    {
        $user_info = CustomHelper::user_info_by_ID($request->id);
        $facility_options = "";
        $facility_option = "";
        // user role select option
        if($user_info->role == 1)
        {
            $user_role = "<option value='". $user_info->role . "'>" . trans('allstr.admin') . "</option>"
                            . "<option value='2'>" . trans('allstr.producer') . "</option>"
                            . "<option value='3'>" . trans('allstr.monitor') . "</option>";
        }
        if($user_info->role == 2)
        {
            $user_role = "<option value='". $user_info->role . "'>" . trans('allstr.producer') . "</option>"
                . "<option value='1'>" . trans('allstr.admin') . "</option>"
                . "<option value='3'>" . trans('allstr.monitor') . "</option>";
        }
        if($user_info->role == 3)
        {
            $user_role = "<option value='". $user_info->role . "'>" . trans('allstr.monitor') . "</option>"
                . "<option value='1'>" . trans('allstr.admin') . "</option>"
                . "<option value='2'>" . trans('allstr.producer') . "</option>";
        }

        // facility select option
        if($user_info->role == 2 && !empty($user_info->facility_id))
        {
            $all_facilities = Facility::where('id', '!=', $user_info->facility_id)->get();
//            dd ($all_facilities);
            foreach ($all_facilities as $each_facility)
            {
                $facility_option = $facility_option . "<option value='". $each_facility->id . "'>" . $each_facility->facility_name . "</option>";
            }
            $facility_options = "<label for='facility_option_edit' class='col-md-6'>"
                                        . trans('allstr.facility')
                                    . "</label>"
                                    . "<div class='col-md-6'>"
                                        . "<select id='facility_selected_edit'>"
                                            . "<option value='". $user_info->facility_id . "'>" . $user_info->facility_name . "</option>"
                                            . "<option value='0'>" . trans('allstr.select_facility_option') . "</option>"
                                            . $facility_option
                                        . "</select>"
                                    . "</div>"
                                ;
        }

        // Data to be displayed in body and footer of modal
        $user_data = "<div class='modal-body'>"
                        . "<div class='form-group'>"
                            . "<label for='edit_name' class='col-md-6'>"
                                . trans('allstr.name')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<input id='edit_name' type='text' class='form-control' name='edit_name' value='" . $user_info->name . "'>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"

                        . "<div class='form-group'>"
                            . "<label for='edit_email' class='col-md-6'>"
                                . trans('allstr.user_email')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<input id='edit_email' type='email' class='form-control' name='edit_email' value='" . $user_info->email . "'>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"

//                        . "<div class='form-group'>"
//                            . "<label for='edit_password' class='col-md-6'>"
//                                . trans('allstr.user_pwd')
//                            . "</label>"
//                            . "<div class='col-md-6'>"
//                                . "<input id='edit_password' type='password' class='form-control' name='edit_password' value='" . $user_info->password . "'>"
//                            . "</div>"
//                        . "</div>"
//                        . "<div class='clearfix'></div>"

                        . "<div class='form-group'>"
                            . "<label for='role_option_edit' class='col-md-6'>"
                                . trans('allstr.user_role')
                            . "</label>"
                            . "<div class='col-md-6 styled-select'>"
                                . "<select id='role_selected_edit'>"
                                    . $user_role
                                . "</select>"
                            . "</div>"
                        . "</div>"
                        . "<div class='clearfix'></div>"

                        . "<div class='form-group' id='div_existing_facility_edit'>"
                            . $facility_options
                        . "</div>"
                        . "<div class='clearfix'></div>"

                    . "</div>"
                    . "<div class='modal-footer'>"
                        . "<button class='btn btn-outline-danger' data-dismiss='modal'>
                                <i class='fa fa-refresh fa-lg' aria-hidden='true'></i> "
                                . trans('allstr.cancel')
                        ."</button>"
                        . "<button class='btn btn-outline-primary' data-dismiss='modal' id='save_change_btn' name='". $user_info->id ."'>
                                <i class='fa fa-floppy-o fa-lg' aria-hidden='true'></i> "
                                . trans('allstr.save')
                        ."</button>"
                    . "</div>"

//                    . "<script src='" . URL::asset('vendors/custom/custom.js') . "'></script>"
                ;
        return $user_data;
    }

    /**
     * Display facility for onchange select option
     * @return string
     */
    public function getfacility()
    {
        $list_of_facis = CustomHelper::list_all_facilities();
        $faci_option="";
        foreach ($list_of_facis as $each_faci)
        {
            $faci_option = $faci_option . "<option value='". $each_faci->id . "'>" . $each_faci->facility_name . "</option>";
        }
        $new_select_data = "<label for='facility_option_edit' class='col-md-6'>"
                                . trans('allstr.facility')
                            . "</label>"
                            . "<div class='col-md-6'>"
                                . "<select id='facility_selected_edit'>"
                                    . "<option value='0'>" . trans('allstr.select_facility_option') . "</option>"
                                    . $faci_option
                                . "</select>"
                            . "</div>"
//                            . "<script src='" . URL::asset('vendors/custom/custom.js') . "'></script>"
                            ;
        return $new_select_data;
    }

    /**
     * Save Editing Data
     * @param Request $request
     */
    public function saveEditUserData(Request $request)
    {
        // CustomHelper::update_user($request->name, $request->email, $request->pwd, $request->role, $request->facil, $request->sid);
        CustomHelper::update_user($request->name, $request->email, $request->role, $request->facil, $request->sid);
        // return view('dashboard/monthlyreport');
        // return view('dashboard/facilitymgmt',['all_facilities' => $fac_result]);
    }

    public function checkExistingEmail(Request $request)
    {
        $existing_email = User::where('email', '=', $request->email)->first();
        if(!empty($existing_email))
        {
            $result = trans('allstr.email_exists');
        }
        else
        {
            $result ="";
        }
        return $result;
    }

    /**
     * Save Editing Data
     * @param Request $request
     */
    public function saveResetPassword(Request $request)
    {
        CustomHelper::update_user_pwd($request->resetpwd, $request->sid);
    }

}

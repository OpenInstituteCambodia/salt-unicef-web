<?php

namespace App;

use App\User;
use App\ProducerMeasurement;
use Illuminate\Support\Facades\Hash;
use App\Facility;
use DB;

class CustomHelper {

// --------------------------- Report Functions --------------------------------------------

    public static function select_producer_measurement($from_date, $to_date){

        $producer_measure = <<<EOT
    select `facilities`.`id` as `faci_id`, `facilities`.`facility_name`,
    SUM(producer_measurements.quantity_salt_processed) as total_salt_produced,
    SUM(producer_measurements.quantity_potassium_iodate) as total_potassium_produced
    from `producer_measurements`
    inner join `facilities`
    on `producer_measurements`.`facility_id` = `facilities`.`id`
    where `producer_measurements`.`date_of_data`
    between '{$from_date} 00:00:00' and '{$to_date} 23:59:59'
    group by `faci_id`
EOT;
        $producer_measure_query = DB::select($producer_measure);

        return $producer_measure_query;

//        $producer_measure = DB::table('producer_measurements')
//                            -> select('facilities.facility_name',
//                                    DB::raw('SUM(producer_measurements.quantity_salt_processed) as total_salt_produced'),
//                                    DB::raw('SUM(producer_measurements.quantity_potassium_iodate) as total_potassium_produced')
//                                )
//                            -> join('facilities', 'producer_measurements.facility_id', '=', 'facilities.id')
//                            ->whereBetween('producer_measurements.date_of_data', ["'" . $from_date . ' 00:00:00' . "'", "'" . $to_date. ' 23:59:59' . "'"])
//                            ->groupby('facilities.facility_name')
//                            ->get();
//        return $producer_measure;
    }

    public static function select_monitor_measurement($from_date, $to_date){
        $monitor_measure = <<<EOT
            select `facilities`.`id` as `faci_id`, `facilities`.`facility_name`, 
            COUNT(`monitor_measurements`.`facility_id`) as num_inspections,
            concat(round(SUM(IF(`monitor_measurements`.`measurement` BETWEEN 16 AND 50, `monitor_measurements`.`measurement`, 0))/COUNT(`monitor_measurements`.`facility_id`),2),'%') AS percentage_samples,
            SUM(IF(`monitor_measurements`.`warning`=1,1,0)) as total_warning
            from `monitor_measurements` inner join `facilities` on `monitor_measurements`.`facility_id` = `facilities`.`id` 
            where `monitor_measurements`.`date_of_visit` between '2018-03-01 00:00:00' and '2018-04-07 23:59:59' 
            group by `faci_id`
EOT;

return $monitor_measure;





    }

    

// --------------------------- Facilities Management Functions --------------------------------------------

    /**
     * Select all Facilities
     * @return Array of all facilities
     */
    public static function list_all_facilities()
    {
        $facility_arr = Facility::all();
        return $facility_arr;
    }

    /**
     * Get User info by ID
     * @param $user_id
     * @return mixed
     */
    public static function faci_info_by_ID($facility_id)
    {
        $faci_info = Facility::where('id', '=', $facility_id)-> first();
        return $faci_info;
    }


    /**
     * Insert new Facility
     * @param $facility_ref_id
     * @param $name
     * @param $latitude
     * @param $longitude
     * @return Newly inserted Facility ID
     */
    public static function save_new_facility($facility_ref_id, $name, $latitude, $longitude)
    {
        $facility = new Facility();
        $facility->facility_ref_id = $facility_ref_id;
        $facility->facility_name = $name;
        $facility->Latitude = $latitude;
        $facility->Longitude = $longitude;
        $facility->save();
        // return newly inserted data
        return $facility->id;
    }

    /**
     * Update Facility info per FacilityID
     * @param $facility_ref_id
     * @param $name
     * @param $latitude
     * @param $longitude
     * @param $fID
     * @return mixed
     */
    public static function update_facility($facility_ref_id, $name, $latitude, $longitude, $fID)
    {
        $facility = Facility::where('id', '=', $fID)->first();
        $facility->facility_ref_id = $facility_ref_id;
        $facility->facility_name = $name;
        $facility->Latitude = $latitude;
        $facility->Longitude = $longitude;
        $facility->save();
        // return newly inserted data
        return $facility->id;
    }

// --------------------------- User Management Functions --------------------------------------------
    /**
     * Select all User and Facility belongs to each user
     * @return mixed
     */
    public static function list_all_users()
    {
        $user_arr = User::select('users.id','users.name', 'users.email', 'users.role', 'users.facility_id', 'facilities.facility_name')
                    ->Leftjoin('facilities', 'users.facility_id', '=', 'facilities.id')->get();
        return $user_arr;
    }

    /**
     * Get User info by ID
     * @param $user_id
     * @return mixed
     */
    public static function user_info_by_ID($user_id)
    {
        $user_info = User::select('users.id','users.name', 'users.email', 'users.role', 'users.facility_id', 'facilities.facility_name')
                    -> Leftjoin('facilities', 'users.facility_id', '=', 'facilities.id')
                    -> where('users.id', '=', $user_id)
                    -> first();
        return $user_info;
    }

    /**
     * Insert new user into TblUser
     * @param $name
     * @param $email
     * @param $password
     * @param $role
     * @param $facility_id
     * @return mixed
     */
    public static function save_new_user($name, $email, $password, $role, $facility_id)
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = $role;
        if($facility_id != 0) $user->facility_id = $facility_id;
        else $user->facility_id=NULL;
        $user->save();
        // return newly inserted data
        return $user->id;
    }

    /**
     * Update user info by UserID
     * @param $name
     * @param $email
     * @param $role
     * @param $facility_id
     * @param $uID
     * @return mixed
     */
    public static function update_user($name, $email, $role, $facility_id, $uID)
    {
        $user = User::where('id','=', $uID)->first();
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        if($facility_id != 0) $user->facility_id = $facility_id;
        else $user->facility_id=NULL;
        $user->save();
        // return newly inserted data
        return $user->id;
    }

// --------------------------- API Functions --------------------------------------------
    /**
     * @param $email
     * @param $pwd
     * Logic
     * Check for existing user
     *  If user exists then
     *      Check for matching username and password
     *          If it is true, select user role and @return message, username, role, facility_id (info)
     *          Else @return incorrect password message
     *  Else @return user doesn't exist message
     */
    public static function user_role_app($email,$pwd) {
        if(!empty($email) & !empty($pwd))
        {
            // check for existing user
            $user = User::where('email','=', $email)->first();
            if(!empty($user))
            {
                // Comparing (input) plain password with password of user in db,
                // Return true if it is matched
                if(Hash::check($pwd, $user->password)== true)
                {
                    $facility = Facility::where('id', "=", $user->facility_id)->first();
                    return collect([
                        'message'=> 'Ok',
                        'user'=> $user,
                        'facility'=> $facility,
                    ]);
                }
                else
                {
                    return collect([
                        'message'=> 'Incorrect password',
                    ]);
                }
            }
            else
            {
                return collect([
                    'message'=> "User doesn't exist",
                ]);
            }

        }
        else {
            return collect([
                'message'=> "No data to process",
            ]);
        }
    }

}





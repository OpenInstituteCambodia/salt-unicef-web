<?php

namespace App;

use App\User;
use App\ProducerMeasurement;
use Illuminate\Support\Facades\Hash;
use App\Facility;
use DB;

class CustomHelper {

// --------------------------- Report Functions --------------------------------------------

    public static function select_producer_measurement($from_date, $to_date, $number_days){

        $producer_measure = <<<EOT
    SELECT `producer_measurements`.`facility_id` AS facil_id, `facilities`.`facility_name`, 
      SUM(producer_measurements.quantity_salt_processed) as total_salt_produced, 
      SUM(producer_measurements.quantity_potassium_iodate) as total_potassium_produced, 
      concat(round(((sum(IF(`producer_measurements`.`measurement_1` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_1`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_2` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_2`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_3` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_3`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_4` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_4`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_5` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_5`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_6` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_6`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_7` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_7`, 0 ))
            +sum(IF(`producer_measurements`.`measurement_8` BETWEEN 30 AND 50 , `producer_measurements`.`measurement_8`, 0 )))/{$number_days}),2),'%') as percentage_days,
      concat(round(1/(SUM(producer_measurements.quantity_salt_processed)/SUM(producer_measurements.quantity_potassium_iodate)),1),":1") AS ratio_iodized_over_potassium
      FROM `producer_measurements` inner join `facilities` on `producer_measurements`.`facility_id` = `facilities`.`id`
      where `producer_measurements`.`date_of_data` between '{$from_date} 00:00:00' and '{$to_date} 23:59:59'
      GROUP by facil_id;
EOT;
// Notice that don't move/tab EOT; otherwise it is error

         $producer_measure_query = DB::select($producer_measure);
         return $producer_measure_query;

    }

    public static function select_monitor_measurement($from_date, $to_date){
        $monitor_measure = <<<EOT
            select `facilities`.`id` as `faci_id`, `facilities`.`facility_name`, 
            COUNT(`monitor_measurements`.`facility_id`) as num_inspections,
            concat(round(SUM(IF(`monitor_measurements`.`measurement` BETWEEN 15 AND 50, `monitor_measurements`.`measurement`, 0))/SUM(IF(`monitor_measurements`.`measurement` BETWEEN 15 AND 50, 1, 0)),2),'%') AS percentage_samples,
            SUM(IF(`monitor_measurements`.`warning`=1,1,0)) as total_warning
            from `monitor_measurements` inner join `facilities` on `monitor_measurements`.`facility_id` = `facilities`.`id` 
            where `monitor_measurements`.`date_of_visit` between '{$from_date} 00:00:00' and '{$to_date} 23:59:59' 
            group by `faci_id`;
EOT;
// Notice that don't move/tab EOT; otherwise it is error

        $monitor_measure_query = DB::select($monitor_measure);
        return $monitor_measure_query;
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
        $user_info = User::select('users.id','users.name', 'users.email', 'users.password', 'users.role', 'users.facility_id', 'facilities.facility_name')
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

    /**
     * Update user password by UserID
     * @param $pwd
     * @param $uID
     * @return mixed
     */
    public static function update_user_pwd($pwd, $uID)
    {
        $user = User::where('id','=', $uID)->first();
        $user->password = Hash::make($pwd);
        $user->save();
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

    /**
     * Select updated records in facilities table
     * @param $number_of_records_app
     * @param $last_download_date
     *
     * Logic
     *
     * If number of records in app = number of records in server (table facilities)
     * => select only update records where update at > last download date
     * Else
     * => select all records in whole table
     * @return those record collection to app
     *
     */
    public static function get_facility_list($number_of_records_app, $last_download_date){

        // select current number of records in tbl facilities
        $total_facility_records = Facility::count();
        //dd($total_facility_records);
        if($total_facility_records == $number_of_records_app){
            // Select updated records where updated_at>$last_download_date
            $query = <<<EOT
            SELECT * FROM `facilities` WHERE updated_at > '{$last_download_date}'
            ;
EOT;
// Notice that don't move/tab EOT; otherwise it is error
            $records = DB::select($query);
            $equal = 1;
        }
        else {
            // Select all records and return to app
            $records = Facility::all();
            $equal = 0;
        }
        return collect([
            'code' => '200',
            'equal' => $equal,
            'data'=> $records
        ]);
    }

}





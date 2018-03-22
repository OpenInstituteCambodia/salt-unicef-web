<?php

namespace App;

use App\User;
use App\ProducerMeasurement;
use Illuminate\Support\Facades\Hash;

class CustomHelper {

//    public static function check_user_role($user_id) {
//        $user_role = Role::join('user_roles', 'roles.id', '=', 'user_roles.role_id')
//                        -> where('user_roles.user_id', '=', $user_id)
//                        -> first();
//                        //-> get();
//        return $user_role;
//        //return $user_role->name;
//    }
//
//    public static function assign_role($user_id, $role)
//    {
//        $user_exist = User::where('user.id', '=', $user_id)->first();
//        if(!empty($user_exist))
//        {
//            $role = Role::where('name', $role)->first();
//            // assign role to user
//            $user_role = new User_Role();
//            $user_role->role_id = $role->id;
//            $user_role->user_id = $user_id;
//            $user_role->save();
//        }
//        return $user_role->id;
//    }
//
//    public static function insert_user($arr_user_data)
//    {
//        // check existing user
//        // if no user exists, then insert data into Tbl_user
//
//    }

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
        // check for existing user
        $user = User::where('email','=', $email)->first();
        if(!empty($user))
        {
            // Comparing (input) plain password with password of user in db,
            // Return true if it is matched
            if(Hash::check($pwd, $user->password)== true)
            {
                return collect([
                    'message'=> 'Ok',
                    'user'=> $user,
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
}





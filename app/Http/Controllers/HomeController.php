<?php

namespace App\Http\Controllers;

use App\CustomHelper;
use App\Role;
use App\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $dd = CustomHelper::check_user_role(Auth::user()->id);
        dd($dd);

//        $admin_role = Role::where('name', 'admin')->first();
//        // assign the login user as Admin user to user_roles
//        $user_role = new User_Role();
//        $user_role->role_id = $admin_role->id;
//        $user_role->user_id = Auth::user()->id;
//        $user_role->save();




    }
}

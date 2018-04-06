<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

// ---- Routes require Auth()-login
Route::group(['middleware' => ['auth']], function(){

    // ----- Display in Dashboard --------
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // --------- User Mgmt - Display, Add, Edit & Delete ---------
    Route::get('/usermgmt', 'DashboardController@userManagement')->name('usermgmt');
    Route::post('/addnewuser', 'UserMgmtController@addNewUser')->name('addnewuser');
    Route::post('/deleteuser', 'UserMgmtController@softDeleteUser')->name('deleteuser');
    Route::post('/userinfo', 'UserMgmtController@displayUserInfoById')->name('userinfo');
    Route::get('/getfacility', 'UserMgmtController@getFacility')->name('getfacility');
    Route::post('/saveuserdata', 'UserMgmtController@saveEditUserData')->name('saveuserdata');

    // --------- Facility Mgmt - Display, Add, Edit & Delete ---------
    Route::get('/facilitymgmt', 'DashboardController@facilityManagement')->name('facilitymgmt');
    Route::post('/addnewfaci', 'FacilityMgmtController@addNewFacility')->name('addnewfaci');
    Route::post('/deletefaci', 'FacilityMgmtController@softDeleteFacility')->name('deletefaci');
    Route::post('/savefacidata', 'FacilityMgmtController@saveEditFacilityData')->name('savefacidata');
    Route::post('/faciinfo', 'FacilityMgmtController@displayFacilityInfoById')->name('faciinfo');

    // --------- Report ---------
    Route::get('/productionreportdisp', 'DashboardController@monthlyProductionReportView')->name('productionreportdisp');
    Route::get('/inspectionreportdisp', 'DashboardController@monthlyMonitoringReportView')->name('inspectionreportdisp');

    Route::post('/productionreport', 'ReportController@monthlyProductionReport')->name('productionreport');
    Route::post('/inspectionreport', 'ReportController@monthlyMonitoringReport')->name('inspectionreport');


    // -------- Log out -------
    Route::get('/logout', 'UserMgmtController@logOut')->name('logout');

}); // .'middleware' => ['auth']



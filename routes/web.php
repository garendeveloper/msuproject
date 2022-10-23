<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserController;
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

Route::get('constructionsbyID/{id}', [MainController::class, 'constructionsbyID'])->name('constructionsbyid');

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('/loginuser');
Route::post('addconstructiontype', [MainController::class, 'addconstructiontype']);
Route::get('get_allconstructiontypes', [MainController::class, 'get_allconstructiontypes']);

Route::get('get_allconstructiontypes_unapproved', [MainController::class, 'get_allconstructiontypes_unapproved']);
Route::get('get_allconstructiontypes_approved', [MainController::class, 'get_allconstructiontypes_approved']);
Route::get('get_constructiondata/{id}', [MainController::class, 'get_constructiondata']);
Route::post('remove_constructiontype/{id}', [MainController::class, 'delete_constructiontype']);
Route::get('get_allmaterials', [MaterialController::class, 'get_allmaterials']);
Route::post('material_action', [MaterialController::class, 'action']);

Route::get('get_allconstructions', [MainController::class, 'get_allconstructions']);
Route::get('get_allconstructionsbyID/{id}', [MainController::class, 'get_allconstructionsbyID']);
Route::get('get_allconstructions_approved', [MainController::class, 'get_allconstructions_approved']);
Route::get('get_allnoturgentconstructions_approved_forscheduling', [MainController::class, 'get_allnoturgentconstructions_approved_forscheduling']);

Route::get('get_allurgentconstructions_approved_forscheduling', [MainController::class, 'get_allurgentconstructions_approved_forscheduling']);

Route::post('construction_actions', [MainController::class, 'construction_actions']);
Route::get('show_construction/{id}', [MainController::class, 'show_construction']);

Route::post('ecm_add', [MainController::class, 'estimatematerialcost_add']);
Route::get('show_allecm/{id}', [MainController::class, 'show_estimatedmaterialcost']);
Route::get('show_emcdata/{id}', [MainController::class, 'show_emcdata']);

Route::get('get_laborData/{id}', [MainController::class, 'get_laborData']);
Route::get('get_allLaborCosts/{id}', [MainController::class, 'get_allLaborCosts']);
Route::post('elc_actions', [MainController::class, 'labor_actions']);
Route::get('get_allEquipments/{id}', [MainController::class, 'get_allEquipments']);
Route::post('eec_actions', [MainController::class, 'equipment_actions']);

Route::get('count_allLaborers/{id}', [MainController::class, 'count_allLaborers']);
Route::get('get_allDepartments', [MainController::class, 'get_allDepartments']);
Route::get('get_allManpowers', [MainController::class, 'get_allManpowers']);
Route::get('get_allEquipment', [MainController::class, 'get_allEquipment']);
Route::get('get_equipmentData/{id}', [MainController::class, 'get_equipmentData']);
Route::get('get_allusers', [UserController::class, 'get_all']);
Route::get('get_allLaborers', [UserController::class, 'get_allLaborers']);
Route::get('get_allForemans', [UserController::class, 'get_allForemans']);
Route::post('scheduling_actions', [MainController::class, 'scheduling_actions']);
Route::get('get_schedules', [MainController::class, 'get_schedules']);
Route::get('/checking_fundsAvailability', [MainController::class, 'funds_availability']);
Route::post('approve_jobRequest/{id}', [MainController::class, 'approve_jobRequest']);
Route::post('/search_constructiontypes', [MainController::class, 'search_constructiontypes'])->name('/search_constructiontypes');

Route::post('change_retirementStatus', [UserController::class, 'change_retirementStatus']);
Route::post('changecolor', [MainController::class, 'changecolor']);
Route::get('get_allScheduledWorkers', [MainController::class, 'get_allScheduledWorkers']);
Route::get('check_worker/{id}', [MainController::class, 'check_worker']);
Route::post('/manpower_actions', [MainController::class, 'manpower_actions']);
Route::get('get_allworkers/{id}', [MainController::class, 'get_allworkers']);
Route::get('remove_workerinschedule/{id}', [MainController::class, 'remove_workerinschedule']);
Route::get('complete_schedule/{id}', [MainController::class, 'complete_schedule']);
Route::get('get_eventInfo/{id}', [MainController::class, 'get_eventInfo']);
Route::get('get_allDesignatedOffices', [MainController::class, 'get_allDesignatedOffices']);

Route::get('get_jobrequestdata/{id}', [MainController::class, 'get_jobrequestdata']);
//user _actions
Route::get('/registration', [LoginController::class, 'registration']);
Route::post('useractions', [UserController::class, 'useractions']);
Route::get('get_userinfo/{id}', [UserController::class, 'get_userinfo']);
Route::get('get_allconstructiontypesById', [MainController::class,'get_allconstructiontypesById']);
Route::post('/register_jobrequestor', [LoginController::class, 'register_jobrequestor']);
Route::get('/fundsclearance/{id}', [MainController::class, 'fundsclearance']);
Route::get('/fundsclearedjobrequest', [MainController::class, 'fundsclearedjobrequest']);

Route::group(['middleware'=> ['AuthCheck']], function(){
    Route::get('/', [LoginController::class, 'index'])->name('/');
    Route::get('/dashboard', [MainController::class, 'index'])->name('/dashboard');
    Route::get('/constructions', [MainController::class, 'constructions']);
    Route::get('/constructiontypes', [MainController::class, 'constructiontypes']);
    Route::get('/materials', [MainController::class, 'materials']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/scheduling', [MainController::class, 'scheduling']);
    Route::get('/jobrequests', [MainController::class, 'jobrequests']);
    Route::get('/jobrequests_report', [MainController::class, 'jobrequests_report']);
    Route::get('/manpowers', [MainController::class, 'manpowers']);
    Route::get('/jobrequest_form', [MainController::class, 'jobrequest_form']); 
    Route::get('/jobrequest_formById/{id}', [MainController::class, 'jobrequest_formById']); 
    Route::get('/alljobrequests', [MainController::class, 'alljobrequests']);
    Route::get('/approvedjobrequests', [MainController::class, 'approvedjobrequests']);
    Route::get('/unapprovedjobrequests', [MainController::class, 'unapprovedjobrequests']);
    Route::get('/estimatedscopeofworks/{id}', [MainController::class, 'estimatedscopeofworks']);

    Route::get('/materialreport/{id}', [MainController::class, 'materialreport']);
    Route::get('/equipmentreport/{id}', [MainController::class, 'equipmentreport']);
    Route::get('/laborreport/{id}', [MainController::class, 'laborreport']);
});


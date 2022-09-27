<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Construction;
use App\Models\ConstructionTypes;
use DB;
use App\Models\User;
use App\Models\Materials;
use App\Models\EstimatedMaterialCost;
use App\Models\EstimatedEquipmentRentalCost;
use Illuminate\Support\Facades\Validator;
use App\Models\EstimatedLaborCost;
use App\Models\Schedules;
use App\Models\UserJobRequestSchedule;
use App\Models\JobRequestSchedule;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                    from departments, users 
                                    where departments.id = users.department_id
                                    and users.id = "'.session('LoggedUser').'"');
            $userinfo = ['userinfo' => $userinfo];
            return view('dashboard', $userinfo);
        }
        else
        {
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
    
    public function constructions() 
    {
        if(!empty(session('LoggedUser'))){
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                    from departments, users 
                                    where departments.id = users.department_id
                                    and users.id = "'.session('LoggedUser').'"');

            $constructions = DB::select('select construction_types.*, constructions.* 
                                from construction_types, constructions
                                where construction_types.id = constructions.constructiontype_id');
            $data = [
                'userinfo' => $userinfo,
                'constructions' => $constructions,
            ];
            return view('constructions', $data);
        }
        else{
            return redirect('/');
        }
    }
    public function constructionsbyID($id)
    {
        if(!empty(session('LoggedUser'))){
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                    from departments, users 
                                    where departments.id = users.department_id
                                    and users.id = "'.session('LoggedUser').'"');

            $constructions = DB::select('select construction_types.*, constructions.* 
                                from construction_types, constructions
                                where construction_types.id = constructions.constructiontype_id
                                and construction_types.id = "'.$id.'"');
            $data = [
                'userinfo' => $userinfo,
                'constructions' => $constructions,
            ];
            return view('constructionsByID', $data);
        }
        else{
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
    public function get_constructiondata($id)
    {
        $data = ConstructionTypes::findOrFail($id);
        echo json_encode($data);
    }
    public function get_allconstructions()
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
        from construction_types, constructions
        where construction_types.id = constructions.constructiontype_id
        order by construction_types.construction_type asc');
        echo json_encode($data);
    }
    public function get_allconstructions_approved()
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
        from construction_types, constructions
        where construction_types.id = constructions.constructiontype_id
        and construction_types.status = 1
        order by constructions.id desc');
        echo json_encode($data);
    }
    public function get_allconstructions_approved_forscheduling()
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
                            from construction_types, constructions
                            where construction_types.id = constructions.constructiontype_id
                            and construction_types.status = 1');

        echo json_encode($data);
    }
    public function construction_actions(Request $request)
    {
        if($request->item == 'delete'){
            $construction = Construction::findOrFail($request->id);
            $construction->delete();
            return response()->json([
                'status' => 200,
                'success' => 'Data successfully deleted!',
             ]);
        }
        else{
            if(!empty($request->id)){
                $construction = Construction::findOrFail($request->id);
                $construction->constructiontype_id = $request->constructiontype_id;
                $construction->construction_name = $request->construction_name;
                $construction->update();
                return response()->json([
                    'status' => 200,
                    'success' => 'Data successfully updated!',
                 ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    'constructiontype_id' => 'required|integer',
                    'construction_name' => 'bail|required|min:5|unique:constructions',
                ]);
                if($validator->fails()){
                    return response()->json([
                        'status' => 400,
                        'errors' => $validator->messages(),
                     ]);
                }
                else{
                    $check_details = Construction::where('construction_name', '=', $request->construction)
                                                ->where('constructiontype_id', '=', $request->construction_type)
                                                ->first();
                    if(!empty($check_details)){
                        return response()->json([
                            'status' => 401,
                            'message' => 'Details already exists!',
                         ]);
                    }
                    else{
                        $construction = new Construction;
                        $construction->constructiontype_id = $request->constructiontype_id;
                        $construction->construction_name = $request->construction_name;
                        $construction->save();
                        return response()->json([
                            'status' => 200,
                            'success' => 'Data successfully added!',
                         ]);
                    }
                }
            }
        }
    }
    public function get_allconstructiontypes()
    {
        $data = DB::SELECT("SELECT *  FROM CONSTRUCTION_TYPES ORDER BY created_at DESC");
        echo json_encode($data);
    }
    public function get_allconstructiontypes_approved()
    {
        $data = DB::SELECT("SELECT *  FROM CONSTRUCTION_TYPES WHERE status = 1");
        echo json_encode($data);
    }
    public function get_allconstructiontypes_unapproved()
    {
        $data = DB::SELECT("SELECT *  FROM CONSTRUCTION_TYPES WHERE status = 0 ORDER BY created_at DESC");
        echo json_encode($data);
    }
    public function delete_constructiontype($id)
    {   
        $checkifno_involvedinothertable = Construction::where('constructiontype_id', '=', $id)->first();
        
        if(!empty($checkifno_involvedinothertable->constructiontype_id)){
            return response()->json([
                'status' => 400,
                'error' => 'Item cannot be deleted! Item has been used in other transaction/s',
            ]);
        }
        else{
            $construction_type = ConstructionTypes::findOrFail($id);
            $construction_type->delete();
            return response()->json([
                'status' => 200,
                'success' => 'Item successfully removed!', 
            ]);
        }
    }
    public function constructiontypes()
    {
        if(!empty(session('LoggedUser'))){
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
            from departments, users 
            where departments.id = users.department_id
            and users.id = "'.session('LoggedUser').'"');
            $constructiontypes = ConstructionTypes::select('*')->orderby('id', 'desc')->get();
            $data = [
                'userinfo' => $userinfo,
                'constructiontypes' => $constructiontypes,
            ];
            return view('constructiontypes', $data);
        }
        else{
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
    public function materials()
    {
        if(!empty(session('LoggedUser'))){
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                        from departments, users 
                        where departments.id = users.department_id
                        and users.id = "'.session('LoggedUser').'"');

            $materials = Materials::all();
            $data = [
                'userinfo' => $userinfo,
                'materials' => $materials,
            ];
            return view('materials', $data);
        }
        else{
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
    public function addconstructiontype(Request $request)
    {
       if(!empty($request->id)){
            $construction_type = ConstructionTypes::findOrFail($request->id);
            $construction_type->construction_type = $request->construction_type;
            $construction_type->update();
            return response()->json([
                'status' => 200,
                'success' => 'Job Request Updated successfully!',
            ]);
       }
       else{
            $validate = Validator::make($request->all(), [
            'construction_type' => 'bail|required|min:5|max:191|unique:construction_types',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $validate->messages(),
                ]);
            }
            else{
                $construction_type = new ConstructionTypes;
                $construction_type->construction_type = $request->construction_type;
                $construction_type->save();
                return response()->json([
                    'status' => 200,
                    'success' => 'Job request has been added successfully!',
                ]);
            }
       }
    }
    //not yet done!
    public function count_allLaborers($id)
    {
        $data = DB::select('select count(users.id) as total from users, departments
                            where departments.id = users.department_id
                            and departments.departmentname = "'.$id.'"');
        echo json_encode($data);
    }
    public function get_allDepartments()
    {
        $data = DB::select('select * from departments');
        echo json_encode($data);
    }
    public function get_equipmentData($id)
    {
        $data = DB::select('select * from estimated_equipment_rental_costs where id =  "'.$id.'"');
        echo json_encode($data);
    }
    public function get_allLaborCosts($id)
    {
        $data = DB::select('select estimated_labor_costs.*
                            from estimated_labor_costs, constructions
                            where constructions.id = estimated_labor_costs.construction_id
                            and constructions.id = "'.$id.'"
                            order by estimated_labor_costs.id desc');
        echo json_encode($data);
    }
    public function get_laborData($id)
    {
        $data = EstimatedLaborCost::where('id', '=', $id)->first();
        echo json_encode($data);
    }
    public function labor_actions(Request $request)
    {
        if($request->remove != "")
        {
            $elc = EstimatedLaborCost::findOrFail($request->remove);
            $elc->delete();
            return response()->json([
                'status' => 200,
                'success' => 'Data successfully removed!' 
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'manpower' => 'required|min:5',
                'no_ofpersons' => 'required',
                'no_ofheaddays' => 'required',
                'no_mandays' => 'required',
                'daily_rate' => 'required',
                'amount' => 'required'
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }
            else
            {
                if($request->elc_id == "")
                {
                    $elc = EstimatedLaborCost::where('manpower', '=', $request->manpower)
                                                ->where('no_ofpersons', '=', $request->no_ofpersons)
                                                ->where('no_ofheaddays', '=', $request->no_ofheaddays)
                                                ->where('no_mandays', '=', $request->no_mandays)
                                                ->where('daily_rate', '=', $request->daily_rate)
                                                ->where('construction_id', '=', $request->construction_id)
                                                ->where('amount', '=', $request->amount)->first();

                    if($elc == "" || empty($elc) || $elc == " " || $elc == null)
                    {
                        $elc = new EstimatedLaborCost;
                        $elc->construction_id = $request->construction_id;
                        $elc->manpower = $request->manpower;
                        $elc->no_ofpersons = $request->no_ofpersons;
                        $elc->no_ofheaddays = $request->no_ofheaddays;
                        $elc->no_mandays = $request->no_mandays;
                        $elc->daily_rate = $request->daily_rate;
                        $elc->amount = $request->amount;
                        $elc->save();
                        return response()->json([
                            'status' => 200,
                            'success' => 'Data successfully added!'
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'status' => 401,
                            'fail' => 'Details already exist!'
                        ]);
                    }
                }
                else
                {
                    $elc = EstimatedLaborCost::findOrFail($request->elc_id);
                    $elc->construction_id = $request->construction_id;
                    $elc->manpower = $request->manpower;
                    $elc->no_ofpersons = $request->no_ofpersons;
                    $elc->no_ofheaddays = $request->no_ofheaddays;
                    $elc->no_mandays = $request->no_mandays;
                    $elc->daily_rate = $request->daily_rate;
                    $elc->amount = $request->amount;
                    $elc->update();
                    return response()->json([
                        'status' => 200,
                        'success' => 'Data successfully updated!'
                    ]);
                }
            }
        }
    }
    public function equipment_actions(Request $request)
    {
        if($request->remove != "")
        {
            $eec = EstimatedEquipmentRentalCost::findOrFail($request->remove);
            $eec->delete();

            return response()->json([
                'status' => 200,
                'success' => 'Data successfully deleted!'
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'equipment' => 'required|min:5',
                'no_ofpersons' => 'required',
                'no_ofheaddays' => 'required',
                'no_mandays' => 'required',
                'daily_rate' => 'required',
                'amount' => 'required',
            ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }
            else
            {
                if($request->eec_id == "")
                {
                    $eec = EstimatedEquipmentRentalCost::where('construction_id', '=', $request->construction_id)
                                                        ->where('equipment', '=', $request->equipment)->first();
                    if($eec == "" || empty($eec) || $eec == " ")
                    {
                        $eec = new EstimatedEquipmentRentalCost;
                        $eec->construction_id = $request->construction_id;
                        $eec->equipment = $request->equipment;
                        $eec->no_ofpersons = $request->no_ofpersons;
                        $eec->no_ofheaddays = $request->no_ofheaddays;
                        $eec->no_mandays = $request->no_mandays;
                        $eec->daily_rate = $request->daily_rate;
                        $eec->amount = $request->amount;
                        $eec->save();
    
                        return response()->json([
                            'status' => 200,
                            'success' => 'Data successfully added!'
                        ]);
                    }                            
                    else 
                    {
                        return response()->json([
                            'status' => 401,
                            'fail' => 'Equipment rental already exists!'
                        ]);
                    }
                }
                else
                {
                    $eec = EstimatedEquipmentRentalCost::findOrFail($request->eec_id);
                    $eec->construction_id = $request->construction_id;
                    $eec->equipment = $request->equipment;
                    $eec->no_ofpersons = $request->no_ofpersons;
                    $eec->no_ofheaddays = $request->no_ofheaddays;
                    $eec->no_mandays = $request->no_mandays;
                    $eec->daily_rate = $request->daily_rate;
                    $eec->amount = $request->amount;
                    $eec->update();
                    
                    return response()->json([
                        'status' => 200,
                        'success' => 'Data successfully updated!'
                    ]);
                }
            }
        }
    }
    public function get_allEquipments($id)
    {
        $data = DB::select('select * from estimated_equipment_rental_costs where construction_id = "'.$id.'" order by id desc');
        echo json_encode($data);
    }
    public function show_emcdata($id)
    {
        $data = EstimatedMaterialCost::findOrFail($id);
        echo json_encode($data);
    }
    //Estimate Material Cost
    public function estimatematerialcost_add(Request $request)
    {
        if(!empty($request->remove_emc_id))
        {
            $emc_id = EstimatedMaterialCost::findOrFail($request->remove_emc_id);
            $emc_id->delete();
            return response()->json([
                'status' => 200,
                'success' => 'Estimated Material Cost Successfully Removed!',
            ]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'unit' => 'required',
                'description' => 'required',
                'unitcost' => 'required',
                'amount' => 'required',
                'quantity' => 'required',
            ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }
            else
            {
                if(!empty($request->emc_id))
                {
                    $emc = EstimatedMaterialCost::findOrFail($request->emc_id);
                    $emc->unit = $request->unit;
                    $emc->description = $request->description;
                    $emc->unitcost = $request->unitcost;
                    $emc->amount = $request->amount;
                    $emc->construction_id = $request->construction_id;
                    $emc->quantity = $request->quantity;
                    $emc->update();
                    return response()->json([
                        'status' => 200,
                        'success' => 'Estimated Material Cost Successfully Updated.',
                    ]);
                }
                else
                {
                    $save = EstimatedMaterialCost::create($request->all());
                    return response()->json([
                        'status' => 200,
                        'success' => 'Material cost successfully estimated.',
                    ]);
                }
            }
        }
    }

    public function show_estimatedmaterialcost($construction_id)
    {
        $emc = DB::SELECT('SELECT constructions.id as constructions_id, constructions.*, 
                                    construction_types.id as constructiontype_id, construction_types.*,
                                    estimated_material_costs.*, estimated_material_costs.id as emc_id
                            FROM construction_types, constructions, estimated_material_costs
                            WHERE construction_types.id = constructions.constructiontype_id
                            AND constructions.id = estimated_material_costs.construction_id
                            AND constructions.id = "'.$construction_id.'"
                            ORDER BY estimated_material_costs.id
                            DESC');
      echo json_encode($emc);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_construction($id)
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
        from construction_types, constructions
        where construction_types.id = constructions.constructiontype_id
        and constructions.id = "'.$id.'"
        order by constructions.id desc');
        echo json_encode($data);
    }
  
    //SCHEDULING 

    public function get_schedules()
    {
        $data = DB::select('select construction_types.construction_type, constructions.construction_name as title, jobrequestschedules.id, schedules.start, schedules.end, jobrequestschedules.color
        from  construction_types, constructions, schedules, jobrequestschedules
        where construction_types.id = constructions.constructiontype_id
        and schedules.id = jobrequestschedules.schedule_id
        and constructions.id = jobrequestschedules.jobrequest_id');
        echo json_encode($data);
    }
    public function scheduling(Request $request) 
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                                    from departments, users 
                                    where departments.id = users.department_id
                                    and users.id = "'.session('LoggedUser').'"');

            $data = [
                'userinfo' => $userInfo
            ];
            if($request->ajax())
            {
                $data = DB::select('select construction_types.*, constructions.*, schedules.*, jobrequestschedules.*, constructions.construction_name as title
                from  construction_types, constructions, schedules, jobrequestschedules
                where construction_types.id = constructions.constructiontype_id
                and schedules.id = jobrequestschedules.schedule_id
                and constructions.id = jobrequestschedules.jobrequest_id
                and date(schedules.start) >= "'.date($request->start).'"
                and date(schedules.end) <= "'.date($request->end).'"');
                return response()->json($data);
            }
            return view('schedulingtask', $data);
        }
        else
        {
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
    public function jobrequests()
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                            from departments, users 
                            where departments.id = users.department_id
                            and users.id = "'.session('LoggedUser').'"');
            $data = [
                'userinfo' => $userInfo
            ];
            return view('jobrequests_reports', $data);
        }
        else  return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function manpowers()
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
            from departments, users 
            where departments.id = users.department_id
            and users.id = "'.session('LoggedUser').'"');
            $data = [
                'userinfo' => $userInfo
            ];
            return view('manpowers', $data);
        }
        else   return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function jobrequest_form()
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
            from departments, users 
            where departments.id = users.department_id
            and users.id = "'.session('LoggedUser').'"');
            $data = [
                'userinfo' => $userInfo
            ];
            return view('jobrequest_form', $data);
        }
        else   return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function scheduling_actions(Request $request)
    {
        if($request->ajax())
        {   
            if($request->type == 'delete')
            {
                $jobrequest_schedule = JobRequestSchedule::findOrFail($request->id);
                if(!$jobrequest_schedule)
                {
                    return response()->json([
                        'status' => 400,
                        'fail' => 'Server Error: Cannot find the job request id',
                    ]);
                }
                else
                {
                    $jobrequest_schedule->delete();
                    return response()->json([
                        'status' => 200,
                        'success' => 'Job request successfully removed',
                    ]);
                }
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'start' => 'required|date',
                    'end' => 'required|date',
                ]);
                if($validator->fails())
                {
                    return response()->json([
                        'status' => 400,
                        'errors' => $validator->messages()
                    ]);
                }
                $schedule = Schedules::whereDate('start', '=', $request->start)
                                    ->whereDate('end', '=', $request->end)->first();
                if(empty($schedule) || $schedule == "")
                {
                    $schedule = new Schedules();
                    $schedule->start = $request->start;
                    $schedule->end = $request->end;
                    $schedule->save();
                    $schedule = $schedule->id;
                }
                else $schedule = $schedule->id;

                if($request->type == 'update')
                {
                    $jobrequest_schedule = JobRequestSchedule::findOrFail($request->id);
                    if(!$jobrequest_schedule)
                    {
                        return response()->json([
                            'status' => 400,
                            'fail' => 'Server Error: Cannot find the job request id',
                        ]);
                    }
                    else
                    {
                        $jobrequest_schedule->schedule_id = $schedule;
                        $jobrequest_schedule->update();
                        return response()->json([
                            'status' => 200,
                            'success' => 'Job request successfully moved the schedule',
                        ]);
                    }
                }
                else
                {

                    $validator = Validator::make($request->all(), [
                        'start' => 'required|date',
                        'end' => 'required|date',
                        'construction' => 'required'
                    ]);
                    if($validator->fails())
                    {
                        return response()->json([
                            'status' => 400,
                            'errors' => $validator->messages()
                        ]);
                    }
                    else
                    {

                        $jobrequest_schedule  = JobRequestSchedule::where('status', '=', 0)
                                                        ->where('jobrequest_id', '=', $request->construction)
                                                        ->first();
                        if($jobrequest_schedule == "")
                        {
                            $jobrequest_schedule = new JobRequestSchedule;
                            $jobrequest_schedule->last_actionBy = session('LoggedUser');
                            $jobrequest_schedule->schedule_id = $schedule;
                            $jobrequest_schedule->jobrequest_id = $request->construction;
                            $jobrequest_schedule->color = $request->color;
                            $jobrequest_schedule->save();
                            $jobrequest_schedule = $jobrequest_schedule->id;
                            return response()->json([
                                'status' => 200,
                                'success' => 'Job request successfully on scheduled!'
                            ]);
                        }
                        else
                        {
                            return response()->json([
                                'status' => 401,
                                'fail' => 'Job request already on scheduled!'
                            ]);
                        }
                        

                    // $foremans = $request->foremans;
                    // $laborers = $request->laborers;

                    // $total_added_foremans = 0;
                    // $total_notadded_foremans = 0;
                    // $foremans_notsaved = [];

                    // $total_added_laborers = 0;
                    // $total_notadded_laborers = 0;
                    // $laborers_notsaved = [];
                    // for($i = 0; $i<count($foremans); $i++)
                    // {
                    //     $user = UserJobRequestSchedule::where('user_id', '=', $foremans[$i])
                    //                             ->where('jobrequestsched_id', '=', $jobrequest_schedule)
                    //                             ->first();
                        
                    //     if($user == "")
                    //     {
                    //         $user = new UserJobRequestSchedule;
                    //         $user->user_id = $foremans[$i];
                    //         $user->jobrequestsched_id = $jobrequest_schedule;
                    //         $user->save();
                    //         $user = $user->id;
                    //         $total_added_foremans += 1;
                    //     }
                    //     else
                    //     {
                    //         $foremans_notsaved[] = [
                    //             'user' => $user_id
                    //         ];
                    //         $total_notadded_foremans += 1;
                    //     }
                    // }
                    // for($i = 0; $i<count($laborers); $i++)
                    // {
                    //     $user = UserJobRequestSchedule::where('user_id', '=', $laborers[$i])
                    //                             ->where('jobrequestsched_id', '=', $jobrequest_schedule)
                    //                             ->first();
                        
                    //     if($user == "")
                    //     {
                    //         $user = new UserJobRequestSchedule;
                    //         $user->user_id = $laborers[$i];
                    //         $user->jobrequestsched_id = $jobrequest_schedule;
                    //         $user->save();
                    //         $user = $user->id;
                    //         $total_added_laborers += 1;
                    //     }
                    //     else
                    //     {
                    //         $laborers_notsaved[] = [
                    //             'user' => $user_id
                    //         ];
                    //         $total_notadded_laborers += 1;
                    //     }
                    // }
                    // return response()->json([
                    //     'status' => 200,
                    //     'total_added_laborers' => $total_added_laborers,
                    //     'total_added_foremans' => $total_added_foremans,
                    //     'total_notadded_laborers' => $total_notadded_laborers,
                    //     'total_notadded_foremans' => $total_notadded_foremans,
                    //     'foremans_notsaved' => $foremans_notsaved,
                    //     'laborers_notsaved' => $laborers_notsaved,
                    // ]);
                    }
                }
            }
        }
    }

    public function funds_availability(Request $request)
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                                from departments, users 
                                where departments.id = users.department_id
                                and users.id = "'.session('LoggedUser').'"');

            $data = [
                'userinfo' => $userInfo
            ];
            return view('funds_availability', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function approve_jobRequest($id)
    {
        $construction_type = ConstructionTypes::findOrFail($id);
        if(! $construction_type )
        {
            return response()->json([
                'status' => 400, 
                'error_msg' => 'Server error: in finding construction type'
            ]);
        }
        else
        {
            $construction_type->status = 1;
            $construction_type->update();
            return response()->json([
                'status' => 200, 
                'success' => 'The job request has been successfully approved!'
            ]);
        }
    }
    public function search_constructiontypes(Request $request)
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
        from construction_types, constructions
        where construction_types.id = constructions.constructiontype_id
        and construction_types.id = "'.$request->construction_type.'"
        order by constructions.construction_name asc');
        dd($data);
        // return redirect()->back()->with('constructions', $data);
    }
    public function jobrequests_report()
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                                from departments, users 
                                where departments.id = users.department_id
                                and users.id = "'.session('LoggedUser').'"');

            $data = [
                'userinfo' => $userInfo
            ];
            return view('jobrequests_reportprint', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function alljobrequests()
    {
        if(!empty(session('LoggedUser')))
        {
            $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                                from departments, users 
                                where departments.id = users.department_id
                                and users.id = "'.session('LoggedUser').'"');

            $data = [
                'userinfo' => $userInfo
            ];
            return view('alljobrequests', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
}

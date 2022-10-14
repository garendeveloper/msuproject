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
use Illuminate\Support\Str;

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
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                        from construction_types
                                        where status = 0');
            $userinfo = ['userinfo' => $userinfo, 
                        'no_ofapproved'=> $no_ofapproved, 
                        'no_ofunapproved'=>$no_ofunapproved
                    ];
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
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                        from construction_types
                                        where status = 0');
          
            $constructions = DB::select('select construction_types.*, constructions.* 
                                from construction_types, constructions
                                where construction_types.id = constructions.constructiontype_id');

            $data = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved,
                'constructions'=>$constructions,
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
            $no_ofapproved = DB::select('select count(*) as total_approved
                            from construction_types
                            where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                            from construction_types
                            where status = 0');

            $constructions = DB::select('select construction_types.*, constructions.* 
                    from construction_types, constructions
                    where construction_types.id = constructions.constructiontype_id');

            $data = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved,
                'constructions'=>$constructions,
                'url_id' => $id
            ];
            return view('constructions', $data);
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
    public function get_jobrequestdata($id)
    {
        $user= DB::select('select users.*, construction_types.*, designated_offices.*, departments.*, construction_types.created_at as dateRequested, construction_types.status
        from users, construction_types, designated_offices, departments
        where users.id = construction_types.user_id
        and designated_offices.id = users.designated_id
        and departments.id = users.department_id
        and construction_types.id = "'.$id.'"');
        
        $scheduling_info = DB::select('select jobrequestschedules.status
        from construction_types, jobrequestschedules
        where construction_types.id = jobrequestschedules.jobrequest_id
        and construction_types.id = "'.$id.'"');
        
        if(empty($scheduling_info)) $scheduling_info[] = [
            'status' => 0
        ];

        $data = [
            'user' => $user,
            'scheduling_info' => $scheduling_info
        ];
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
    public function get_allconstructionsbyID($id)
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
        from construction_types, constructions
        where construction_types.id = constructions.constructiontype_id
        and construction_types.id = "'.$id.'"
        order by construction_types.created_at desc');
        echo json_encode($data);
    }
    public function approvedjobrequests()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                    from departments, users 
                                    where departments.id = users.department_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                        from construction_types
                                        where status = 0');
            $jobrequests = DB::SELECT("SELECT CONSTRUCTION_TYPES.*, users.name, designated_offices.designation, departments.departmentname
                                FROM CONSTRUCTION_TYPES, users, designated_offices, departments
                                WHERE users.id = construction_types.user_id 
                                and designated_offices.id = users.designated_id
                                and construction_types.status = 1
                                and departments.id = users.department_id
                                ORDER BY construction_types.created_at ASC");
            $userinfo = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=>$no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved,
                'jobrequests' => $jobrequests,
            ];
            return view('approvedjobrequests', $userinfo);
        }
        else
        {
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
  
    public function unapprovedjobrequests()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                    from departments, users 
                                    where departments.id = users.department_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                        from construction_types
                                        where status = 0');
            $jobrequests = DB::SELECT("SELECT CONSTRUCTION_TYPES.*, users.name, designated_offices.designation, departments.departmentname
                                FROM CONSTRUCTION_TYPES, users, designated_offices, departments
                                WHERE users.id = construction_types.user_id 
                                and designated_offices.id = users.designated_id
                                and construction_types.status = 0
                                and departments.id = users.department_id
                                ORDER BY construction_types.created_at ASC");
            $userinfo = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=>$no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved,
                'jobrequests' => $jobrequests,
            ];
            return view('unapprovedjobrequests', $userinfo);
        }
        else
        {
            return redirect('/')->with('fail', 'You must be logged in!');
        }
    }
    public function get_allconstructions_approved()
    {
        $data = DB::select('select construction_types.*, constructions.*, constructions.id as construction_id
        from construction_types, constructions
        where construction_types.id = constructions.constructiontype_id
        and construction_types.status = 1
        and constructions.id NOT IN (SELECT jobrequestschedules.jobrequest_id 
                                          FROM jobrequestschedules
                                          WHERE jobrequestschedules.status = 1)
        order by constructions.id desc ');
        echo json_encode($data);
    }
    public function get_allurgentconstructions_approved_forscheduling()
    {
        $data = DB::select('SELECT id as construction_id, construction_types.*
                            from construction_types
                            where status = 1
                            and construction_types.id not in (select jobrequest_id from jobrequestschedules)
                            order by urgentstatus = 1 desc');

        echo json_encode($data);
    }
    public function get_allnoturgentconstructions_approved_forscheduling()
    {
        $data = DB::select('select construction_types.*, construction_types.id as construction_id
                            from construction_types
                            where construction_types.status = 1
                            and urgentstatus = 0');

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
        else
        {
            if(!empty($request->id))
            {
                $construction = Construction::findOrFail($request->id);
                $construction->constructiontype_id = $request->constructiontype_id;
                $construction->construction_name = $request->construction_name;
                $construction->update();
                return response()->json([
                    'status' => 200,
                    'success' => 'Data successfully updated!',
                 ]);
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'constructiontype_id' => 'required|integer',
                    'construction_name' => 'bail|required|min:5|unique:constructions',
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
    //THIS IS THE ALGORITHM FOR FIFO
    public function get_allconstructiontypes()
    {
        $data = DB::SELECT("SELECT CONSTRUCTION_TYPES.*, users.name  
                            FROM CONSTRUCTION_TYPES, users 
                            WHERE users.id = construction_types.user_id 
                            ORDER BY construction_types.urgentstatus = 1 DESC");
        echo json_encode($data);
    }
    public function get_allconstructiontypesById()
    {
        $user_id = session('LoggedUser');
        $data = DB::SELECT('SELECT CONSTRUCTION_TYPES.*, users.name  
                            FROM CONSTRUCTION_TYPES, users 
                            WHERE users.id = construction_types.user_id 
                            AND users.id = "'.$user_id.'"
                            ORDER BY construction_types.created_at ASC');
        echo json_encode($data);
    }
    public function get_allconstructiontypes_approved()
    {
        // $data = DB::SELECT("SELECT *  FROM CONSTRUCTION_TYPES WHERE status = 1");
        $data = DB::SELECT("SELECT CONSTRUCTION_TYPES.*, users.name, designated_offices.designation
        FROM CONSTRUCTION_TYPES, users, designated_offices
        WHERE users.id = construction_types.user_id 
        and designated_offices.id = users.designated_id
        and construction_types.status = 1
        ORDER BY construction_types.created_at ASC");
        echo json_encode($data);
    }
    public function get_allconstructiontypes_unapproved()
    {
        $data = DB::SELECT("SELECT CONSTRUCTION_TYPES.*, users.name, designated_offices.designation
                            FROM CONSTRUCTION_TYPES, users, designated_offices
                            WHERE users.id = construction_types.user_id 
                            and designated_offices.id = users.designated_id
                            ORDER BY construction_types.urgentstatus = 1 DESC");
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
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                        from construction_types
                                        where status = 0');
            $constructiontypes = ConstructionTypes::select('*')->orderby('id', 'desc')->get();
            $data = [
                        'userinfo' => $userinfo, 
                        'no_ofapproved'=> $no_ofapproved, 
                        'no_ofunapproved'=>$no_ofunapproved,
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
        // $urgentstatus = 0;
        // if($request->urgent) $urgentstatus = 1;
       if(!empty($request->id))
       {
            $construction_type = ConstructionTypes::findOrFail($request->id);
            $construction_type->urgentstatus = $request->urgent;
            $construction_type->construction_type = $request->construction_type;
            $construction_type->update();
            return response()->json([
                'status' => 200,
                'success' => 'Job Request Updated successfully!',
            ]);
       }
       else
       {
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
                $construction_type->user_id = session('LoggedUser');
                $construction_type->construction_type = $request->construction_type;
                $construction_type->urgentstatus = $request->urgent;
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
    public function get_allDesignatedOffices()
    {
        $data = DB::select('select * from designated_offices');
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
    public function get_eventInfo($id)
    {
        $scheduleinfo = DB::select('select users.name, designated_offices.designation, departments.departmentname, construction_types.construction_type as title, schedules.*, jobrequestschedules.*
        from users, designated_offices, departments, construction_types, schedules, jobrequestschedules
        where construction_types.id = jobrequestschedules.jobrequest_id
        and schedules.id = jobrequestschedules.schedule_id
        and designated_offices.id = users.designated_id
        and departments.id = users.department_id
        and users.id = construction_types.user_id
        and jobrequestschedules.id = "'.$id.'"');
        $manpower = DB::select('select users.*
        from users, userjobrequestschedules, jobrequestschedules
        where users.id = userjobrequestschedules.user_id
        and jobrequestschedules.id = userjobrequestschedules.jobrequestsched_id
        and jobrequestschedules.id = "'.$id.'"');
        $data = [
            'scheduleinfo' => $scheduleinfo,
            'manpowers' => $manpower
        ];
        echo json_encode($data);
    }  
    public function get_schedules()
    {
        $data = DB::select('select construction_types.construction_type as title, jobrequestschedules.id, schedules.start, schedules.end, jobrequestschedules.color, jobrequestschedules.status
        from  construction_types,  schedules, jobrequestschedules
        where schedules.id = jobrequestschedules.schedule_id
        and construction_types.id = jobrequestschedules.jobrequest_id
        ');

        $events = array();
        foreach($data as $d)
        {
            if($d->status == 1)
            {
                $events[] = [
                    'title' => 'THIS SCHEDULE HAS BEEN COMPLETED',
                    'start' => $d->start,
                    'end'   => $d->end,
                    'id'    => $d->id,
                    'color' => $d->color,
                    'status' => $d->status,
                    'editable' => false,
                    'click' => false,
                ];
            }
            else
            {
                $events[] = [
                    'title' => $d->title,
                    'start' => $d->start,
                    'end'   => $d->end,
                    'id'    => $d->id,
                    'color' => $d->color,
                    'status' => $d->status,
                    'editable' => true,
                    'click' => true,
                ];
            }
        }
        echo json_encode($events);
    }
    public function scheduling(Request $request) 
    {
        if(!empty(session('LoggedUser')))
        {
            // $userInfo = DB::select('select users.*, users.id as user_id, departments.*
            //                         from departments, users 
            //                         where departments.id = users.department_id
            //                         and users.id = "'.session('LoggedUser').'"');

            // $data = [
            //     'userinfo' => $userInfo
            // ];
            // if($request->ajax())
            // {
            //     $data = DB::select('select construction_types.*, constructions.*, schedules.*, jobrequestschedules.*, constructions.construction_name as title
            //     from  construction_types, constructions, schedules, jobrequestschedules
            //     where construction_types.id = constructions.constructiontype_id
            //     and schedules.id = jobrequestschedules.schedule_id
            //     and constructions.id = jobrequestschedules.jobrequest_id
            //     and date(schedules.start) >= "'.date($request->start).'"
            //     and date(schedules.end) <= "'.date($request->end).'"');
            //     return response()->json($data);
            // }
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                from departments, users 
                                where departments.id = users.department_id
                                and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                            from construction_types
                            where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                            from construction_types
                            where status = 0');
            $data = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved
            ];
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
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                from departments, users 
                                where departments.id = users.department_id
                                and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                            from construction_types
                            where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                            from construction_types
                            where status = 0');
            $data = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved
            ];
            return view('jobrequests_reports', $data);
        }
        else  return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function manpowers()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.*, users.id as user_id, departments.*
                                from departments, users 
                                where departments.id = users.department_id
                                and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                            from construction_types
                            where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                            from construction_types
                            where status = 0');
            $data = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved
            ];
            return view('manpowers', $data);
        }
        else   return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function jobrequest_form()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                    from construction_types
                    where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                    from construction_types
                    where status = 0');
            $data = [
                'jr_info'=> '',
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved
            ];
            
            return view('jobrequest_form', $data);
        }
        else   return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function jobrequest_formById($jobrequest_id)
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $constructiondata = DB::select('select construction_types.*, users.name,users.email, users.phone_num, departments.departmentname, designated_offices.designation
                                            from designated_offices, departments, construction_types, users
                                            where designated_offices.id = users.designated_id
                                            and departments.id = users.department_id
                                            and users.id = construction_types.user_id
                                            and construction_types.id = "'.$jobrequest_id.'"');

            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                    from construction_types
                    where status = 0');
            $data = [
                'jr_info'=>$constructiondata,
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved
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
                    }
                }
            }
        }
    }

    public function funds_availability(Request $request)
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                            from construction_types
                                            where status = 0');
            $data = [
                    'userinfo' => $userinfo, 
                    'no_ofapproved'=> $no_ofapproved, 
                    'no_ofunapproved'=>$no_ofunapproved
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
    public function estimatedscopeofworks($jobrequest_id)
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                            from construction_types
                                            where status = 0');
            $data = [
                    'userinfo' => $userinfo, 
                    'no_ofapproved'=> $no_ofapproved, 
                    'no_ofunapproved'=>$no_ofunapproved
                    ];
            return view('estimatedscopeofworks', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function materialreport($jobrequest_id)
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                            from construction_types
                                            where status = 0');
            
            $total_emc = DB::select('SELECT sum(estimated_material_costs.amount) as emc_total
                                    FROM estimated_material_costs, constructions
                                    WHERE constructions.id = estimated_material_costs.construction_id
                                    AND constructions.constructiontype_id = "'.$jobrequest_id.'"');
            $total_eer = DB::select('SELECT sum(estimated_equipment_rental_costs.amount) as eer_total
                                    FROM estimated_equipment_rental_costs, constructions
                                    WHERE constructions.id = estimated_equipment_rental_costs.construction_id
                                    AND constructions.constructiontype_id = "'.$jobrequest_id.'"');
            
            $total_elc = DB::select('SELECT sum(estimated_labor_costs.amount) as elc_total
                                    FROM estimated_labor_costs, constructions
                                    WHERE constructions.id = estimated_labor_costs.construction_id
                                    AND constructions.constructiontype_id = "'.$jobrequest_id.'"');

            $scopeofworks = Construction::where('constructiontype_id', '=', $jobrequest_id)->get();
            
            $total_projectcost = $total_emc[0]->emc_total + $total_eer[0]->eer_total + $total_elc[0]->elc_total;
            
            $data = [
                    'userinfo' => $userinfo, 
                    'no_ofapproved'=> $no_ofapproved, 
                    'no_ofunapproved'=>$no_ofunapproved,
                    'total_emc'=>$total_emc,
                    'total_eer'=>$total_eer,
                    'total_elc'=>$total_elc,
                    'total_projectcost'=>$total_projectcost,
                    'scopeofworks' => $scopeofworks,
                    'jobrequestdetails' => ConstructionTypes::find($jobrequest_id) 
                    ];
            return view('materialreport', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function equipmentreport($jobrequest_id)
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                            from construction_types
                                            where status = 0');
            $data = [
                    'userinfo' => $userinfo, 
                    'no_ofapproved'=> $no_ofapproved, 
                    'no_ofunapproved'=>$no_ofunapproved
                    ];
            return view('equipmentreport', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function laborreport($jobrequest_id)
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                            from construction_types
                                            where status = 0');
            $data = [
                    'userinfo' => $userinfo, 
                    'no_ofapproved'=> $no_ofapproved, 
                    'no_ofunapproved'=>$no_ofunapproved
                    ];
            return view('laborreport', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function jobrequests_report()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                                    from users, departments, designated_offices
                                    where departments.id = users.department_id
                                    and designated_offices.id = users.designated_id
                                    and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                                        from construction_types
                                        where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                            from construction_types
                                            where status = 0');
            $data = [
                    'userinfo' => $userinfo, 
                    'no_ofapproved'=> $no_ofapproved, 
                    'no_ofunapproved'=>$no_ofunapproved
                    ];
            return view('jobrequests_reportprint', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
    public function alljobrequests()
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
            from users, departments, designated_offices
            where departments.id = users.department_id
            and designated_offices.id = users.designated_id
            and users.id = "'.session('LoggedUser').'"');
            $no_ofapproved = DB::select('select count(*) as total_approved
                            from construction_types
                            where status = 1');
            $no_ofunapproved = DB::select('select count(*) as total_unapproved
                                from construction_types
                                where status = 0');
            $data = [
                'userinfo' => $userinfo, 
                'no_ofapproved'=> $no_ofapproved, 
                'no_ofunapproved'=>$no_ofunapproved
            ];
            return view('alljobrequests', $data);
        }
       return redirect('/')->with('fail', 'You must be logged in!');
    }
   
    public function changecolor(Request $request)
    {
        $jobrequest = JobRequestSchedule::findOrFail($request->id);
        $jobrequest->color = $request->color;
        $jobrequest->update();
        return response()->json([
            'status' => 200,
            'success'=> 'Color has been successfully changed'
        ]);
    }
    public function manpower_actions(Request $request)
    {
        $foremans = $request->foremans;
        $jobrequest_id = $request->jobrequest_id;

        $validator = Validator::make($request->all(), [
            'foremans' => 'required',
            'jobrequest_id' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' =>$validator->messages
            ]);
        }
        else
        {
            $users_existed = [];
            for($i = 0; $i<count($foremans); $i++)
            {
                $check_ifExist = UserJobRequestSchedule::where('user_id', '=', $foremans[$i])
                                                        ->where('jobrequestsched_id', '=', $jobrequest_id)->first();
                
                if($check_ifExist == "" || empty($check_ifExist))
                {
                    $userjrsched = new UserJobRequestSchedule;
                    $userjrsched->jobrequestsched_id = $jobrequest_id;
                    $userjrsched->user_id = $foremans[$i];
                    $userjrsched->save();
                }
                else
                {
                    $users_existed = [
                        'user' => $foremans[$i]
                    ];
                }
            }
            return response()->json([
                'status' => 200,
                'success' => 'Employee has been successfully scheduled.',
                'users' => $users_existed,
            ]);
        }  
        
    }
    public function get_allScheduledWorkers()
    {
        $data = DB::select('SELECT users.*, departments.departmentname
        FROM users, departments
        WHERE departments.id = users.department_id
        and users.id NOT IN 
        (SELECT users.id as user_id 
         FROM users, userjobrequestschedules, jobrequestschedules
        WHERE users.id = userjobrequestschedules.user_id 
        AND jobrequestschedules.id = userjobrequestschedules.jobrequestsched_id
        AND jobrequestschedules.status = 0)
        and users.retirementstatus = 0 ');
        
        echo json_encode($data);
    }
    public function check_worker($id)
    {
        $check = 1;
        $data = DB::select('SELECT distinct users.id as user_id
                    FROM userjobrequestschedules, users, jobrequestschedules
                    WHERE users.id  = userjobrequestschedules.user_id
                    and jobrequestschedules.id = userjobrequestschedules.jobrequestsched_id
                    and jobrequestschedules.status = 0
                    and users.id = "'.$id.'"');
        if(empty($data)) 
        {
            $check  = 0;
        }
        echo json_encode($check);
    }
    public function get_allworkers($id)
    {
        $workers = DB::select('SELECT users.*, userjobrequestschedules.id as userjobrequest_id
                            FROM users, userjobrequestschedules, jobrequestschedules
                            WHERE users.id = userjobrequestschedules.user_id 
                            AND jobrequestschedules.id = userjobrequestschedules.jobrequestsched_id
                            AND jobrequestschedules.status = 0
                            and users.retirementstatus = 0 
                            and jobrequestschedules.id = "'.$id.'"');
        echo json_encode($workers);
    }
    public function remove_workerinschedule($userjobrequest_id)
    {
        $userjobrequest = UserJobRequestSchedule::findOrFail($userjobrequest_id);
        $userjobrequest->delete();
        return response()->json([
            'status' => 200,
            'success' => 'Selected Person Successfully Removed!'
        ]);

    }
    public function complete_schedule($jobrequest_id)
    {
        $userjobrequest = UserJobRequestSchedule::where('jobrequestsched_id', '=', $jobrequest_id)->first();
        if($userjobrequest == "")
        {
            return response()->json([
                'status' => 201,
                'message' => 'Please select a foreman to complete the process!'
            ]);
        }
        else    
        {
            $jobrequest = JobRequestSchedule::findOrFail($jobrequest_id);
            $jobrequest->status = 1;
            $jobrequest->color = "green";
            $jobrequest->update();
            return response()->json([
                'status' => 200,
                'success' => 'Construction has been successfully completed!'
            ]);
        }
    }
}

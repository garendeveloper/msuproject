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
            $userinfo = ['userinfo' => User::where('id', '=', session('LoggedUser'))->first()];
            return view('dashboard', $userinfo);
        }
        else
        {
            return redirect('/');
        }
    }
    
    public function constructions() 
    {
        if(!empty(session('LoggedUser'))){
            $userinfo = User::where('id', '=', session('LoggedUser'))->first();
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
        order by constructions.id desc');
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
        $data = DB::SELECT("SELECT *  FROM CONSTRUCTION_TYPES");
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
            $userinfo = User::where('id', '=', session('LoggedUser'))->first();
            $constructiontypes = ConstructionTypes::select('*')->orderby('id', 'desc')->get();
            $data = [
                'userinfo' => $userinfo,
                'constructiontypes' => $constructiontypes,
            ];
            return view('constructiontypes', $data);
        }
        else{
            return redirect('/');
        }
    }
    public function materials()
    {
        if(!empty(session('LoggedUser'))){
            $userinfo = User::where('id', '=', session('LoggedUser'))->first();
            $materials = Materials::all();
            $data = [
                'userinfo' => $userinfo,
                'materials' => $materials,
            ];
            return view('materials', $data);
        }
        else{
            return redirect('/');
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
                'success' => 'Data Updated successfully!',
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
                    'success' => 'Data added successfully!',
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

    public function scheduling(Request $request) 
    {
        if(!empty(session('LoggedUser')))
        {
            $userinfo = User::where('id', '=', session('LoggedUser'))->first();
    
            $data = [
                'userinfo' => $userinfo
            ];
            if($request->ajax())
            {
                $data = DB::select('select * from schedules
                                    where start >= "'.$request->start.'"
                                    and end <= "'.$request->end.'"');
                echo json_encode($data);
            }
            return view('scheduling', $data);
        }
        else
        {
            return redirect('/');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Construction;
use App\Models\ConstructionTypes;
use DB;
use App\Models\User;
use App\Models\Materials;
use App\Models\EstimatedMaterialCost;

use Illuminate\Support\Facades\Validator;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function get_allEquipments()
    {
        $data = DB::select('select * from estimated_equipment_rental_costs order by id desc');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materials;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_allmaterials()
    {
        $data = Materials::select("*")->orderby('id', 'desc')->get();
        echo json_encode($data);
    }
    public function action(Request $request)
    {
        if($request->item == 'remove'){
            $material = Materials::findOrFail($request->id);
            $material->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Item has been successfuly deleted!',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'material' => 'bail|required|min:3|unique:materials',
            ]);
    
            if(!empty($request->id)){
                $material = Materials::findOrFail($request->id);
                $material->material = $request->material;
                $material->quantity = $request->quantity;
                $material->amount = $request->amount;
                $material->update();
                return response()->json([
                    'status' => 200,
                    'success' => 'Data successfully updated!',
                ]);
            }
            else{
                if($validator->fails()){
                    return response()->json([
                        'status' => 400,
                        'errors' => $validator->messages(),
                    ]);
                }
                else{
                    $material = new Materials;
                    $material->material = $request->material;
                    $material->quantity = $request->quantity;
                    $material->amount = $request->amount;
                    $material->save();

                    return response()->json([
                        'status' => 200,
                        'success' => 'Data successfully added!',
                    ]);
                }
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

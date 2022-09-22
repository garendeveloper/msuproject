<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInfo = DB::select('select users.*, users.id as user_id, departments.*
                            from departments, users 
                            where departments.id = users.department_id
                            and users.id = "'.session('LoggedUser').'"');
        $data = [
            'userinfo' => $userInfo
        ];
        return view('users', $userinfo);
    }
    public function get_all()
    {
        $users = User::all();
        echo json_encode($users);
    }
    public function get_allLaborers()
    {
        $data = DB::select('select users.id as user_id, users.*, departments.*
                            from users, departments
                            where departments.id = users.department_id
                            and departments.departmentname = "Laborer"');
        echo json_encode($data);
    }
    public function get_allForemans()
    {
        $data = DB::select('select users.id as user_id, users.*, departments.*
                            from users, departments
                            where departments.id = users.department_id
                            and departments.departmentname = "Foreman"');
        echo json_encode($data);
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

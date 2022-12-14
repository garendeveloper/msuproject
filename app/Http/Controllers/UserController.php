<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\Departments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\FullnameRule;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        return view('users', $data);
    }
    public function get_all()
    {
        $users = DB::select('select users.*, users.id as user_id, departments.*, designated_offices.*
                            from departments, users, designated_offices
                            where departments.id = users.department_id
                            and designated_offices.id = users.designated_id
                            order by users.created_at desc');
        echo json_encode($users);
    }
    public function change_retirementStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        if($request->type == 'reemployed')
        {
            $user->retirementstatus = 0;
            $user->update();
        }
        if($request->type == 'retired')
        {
            $user->retirementstatus = 1;
            $user->update();
           
        }
        return response()->json([
            'status' => 200,
            'success' => 'Status of employee has been successfully processed!'
        ]);
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
    public function get_userinfo($user_id)
    {
        $data = DB::select('select users.id as user_id, users.*, departments.*, designated_offices.*
                            from users, departments, designated_offices
                            where departments.id = users.department_id
                            and designated_offices.id = users.designated_id
                            and users.id = "'.$user_id.'"');
        echo json_encode($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function useractions(Request $request)
    {
        if($request->id != "" || !empty($request->id))
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required', new FullnameRule(), 'unique:users,name,'.$request->id.',id'],
                'email' => 'unique:users,email,'.$request->id.',id',
                'phone_num' => 'required|numeric|min:11',
                'departmentname' => 'required',
                'designation' => 'required',
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
                $username = str_replace(' ', '', strtolower($request->name));
                $password = Hash::make($username);
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_num = $request->phone_num;
                $user->department_id = $request->departmentname;
                $user->designated_id = $request->designation;
                $user->username = $username;
                $user->password = $password;
                $user->update();

                return response()->json([
                    'status' => 200,
                    'success' => 'User has been successfully updated!',
                ]);
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required', new FullnameRule(), 'unique:users'],
                'email' => 'unique:users',
                'phone_num' => 'required|numeric|min:11',
                'departmentname' => 'required',
                'designation' => 'required',
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
                $check_user = User::where('designated_id', $request->designated_id)
                                ->where('department_id', $request->department_id)
                                ->where('name', $request->name)
                                ->first();

                if(empty($check_user) || $check_user == "")
                {
                    $username = str_replace(' ', '', strtolower($request->name));
                    $password = Hash::make($username);
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone_num = $request->phone_num;
                    $user->department_id = $request->departmentname;
                    $user->designated_id = $request->designation;
                    $user->username = $username;
                    $user->password = $password;
                    $user->save();

                    return response()->json([
                        'status' => 200,
                        'success' => 'User has been successfully added!',
                    ]);
                }
                else
                {
                    return response()->json([
                        'status' => 201,
                        'fails' => 'Sorry, User details already exists!',
                    ]);
                }
            }
        }
        
    }
}

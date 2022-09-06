<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        session()->pull('LoggedUser');
        return view('login');
    }
    public function loginuser(Request $request)
    {
        $request->validate([
            'username' => 'required|min:5|max:45',
            'department' => 'required',
            'password' => 'required',
        ]);

        $userInfo  = User::where('username', '=', $request->username)->first();
        
        if(!$userInfo){
            return back()->with('fail', 'Sorry, we do not recognize your username');
        }
        else{
            $department = Departments::where('departmentname', '=', $request->department)->first();
            if(Hash::check($request->password, $userInfo->password) AND ($department->id == $userInfo->department_id)){
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/dashboard');
            }
            else{
                return back()->with('fail', 'Please check your password or username.');
            }
        }
    }
    public function logout()
    {
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/');
        }
    }
}

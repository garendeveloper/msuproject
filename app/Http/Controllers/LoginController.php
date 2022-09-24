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
            'password' => 'required',
        ]);

        $userInfo  = User::where('username', '=', $request->username)->first();
        
        if(!$userInfo){
            return back()->with('fail', 'Sorry, we do not recognize your username');
        }
        else{
            // $department = Departments::where('departmentname', '=', $request->department)->first();
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                $check_department = Departments::where('id', $userInfo->department_id)->first();
                if($check_department->departmentname == "PPU HEAD" || $check_department->departmentname == "ppuhead")  return redirect('/dashboard');
                else if($check_department->departmentname == "FINANCIAL DIVISION" || $check_department->departmentname == "financial")  return redirect('/checking_fundsAvailability');
                else if($check_department->departmentname == "PPU PERSONNEL" || $check_department->departmentname == "ppupersonnel")  return redirect('/constructiontypes');
                else return back()->with('fail', 'Sorry, You have not permission to access the system.');
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
            return redirect('/')->with('success', 'Thank you for your time! Explore again!');
        }
    }
}

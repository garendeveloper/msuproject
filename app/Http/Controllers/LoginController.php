<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Support\Facades\Hash;
use App\Rules\FullnameRule;
use App\Rules\PasswordRule;
use App\Models\DesignatedOffice;
class LoginController extends Controller
{
    public function index()
    {
        session()->pull('LoggedUser');
        return view('login');
    }
    public function registration()
    {
        session()->pull('LoggedUser');
        return view('registrationform');
    }
    public function register_jobrequestor(Request $request)
    {
        $request->validate([
            'name' => ['required', new FullnameRule(), 'unique:users'],
            'email' => 'unique:users',
            'phone_num' => 'required|numeric|min:11',
            'designation' => 'required',
            'username' => 'required|min:5|unique:users',
            'password' => ['required', 'between:8,255', 'confirmed'],
        ]);

        
        $userInfo  = User::where('username', '=', $request->username)->first();

        if($userInfo != "")
        {
            if(Hash::check($request->password, $userInfo->password))
            {
                return redirect()->back()->withInput($request->all())->with('fail', 'Password already exists!');
            }
        }
        else 
        {
            
            $designation = DesignatedOffice::where('designation', '=', $request->designation)->first();

            if($designation == "")
            {
                $designation = new DesignatedOffice;
                $designation->designation = $request->designation;
                $designation->save();
                $designation = $designation->id;
            }
            else $designation = $designation->id;
    
            $department = Departments::where('departmentname', '=', "JOB REQUESTOR")->first();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_num = $request->phone_num;
            $user->department_id = $department->id;
            $user->designated_id = $designation;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            $request->session()->put('LoggedUser', $user->id);
            return redirect('/jobrequest_form');
        }
    }
    public function loginuser(Request $request)
    {
        $request->validate([
            'username' => 'required|min:5|max:45',
            'password' => 'required',
        ]);

        $userInfo  = User::where('username', '=', $request->username)->first();
        
        if(!$userInfo){
            return back()->with('fail', 'Sorry, but you do not have access to the system.');
        }
        else{
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                $check_department = Departments::where('id', $userInfo->department_id)->first();
                if($check_department->departmentname == "PPU HEAD" || $check_department->departmentname == "ppuhead")  return redirect('/dashboard');
                else if($check_department->departmentname == "JOB REQUESTOR" || $check_department->departmentname == "jobrequestor")  return redirect('/jobrequest_form');
                else if($check_department->departmentname == "FINANCIAL DIVISION" || $check_department->departmentname == "financial")  return redirect('/checking_fundsAvailability');
                else return back()->with('fail', 'Sorry, but you do not have permission to access the system.');
            }
            else{
                return back()->with('fail', 'Please check your username or password.');
            }
        }
    }
    public function logout()
    {
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/')->with('success', 'Thank you for your time. Stay safe!');
        }
    }
}

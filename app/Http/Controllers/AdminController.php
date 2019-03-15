<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request -> isMethod('post'))
        {
            $data=$request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>['1']])){
                //Session::put('adminSession',$data['email']);
                return redirect('/admin/dashboard');
            }
            else {
                return redirect('/admin')->with('flash_error_message','Invalid Email And Password');
        }
    }
    	
    	return view('admin.admin_login');
    }
    public function dashboard()
    {
    	return view('admin.dashboard');
    }
   
    public function setting()
    {
        return view('admin.setting');
    }
    public function chkPassword(Request $request)
    {
        $data=$request->all();
        $current_password=$data['current_pwd'];
        $check_password=User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
        
    }
     public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_success_message','Logout out Successfully');
    }
}

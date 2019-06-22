<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
use App\Admin;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request -> isMethod('post'))
        {
            $data=$request->input();
       $adminCount=Admin::where(['username'=>$data['username'],'password'=>md5($data['password']) ,'status'=>1])->count();if($adminCount>0){ 
            Session::put('adminSession',$data['username']);
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
        $adminDetails=Admin::where(['username'=>Session::get('adminSession')])->first();
           // echo "<pre>"; print_r($adminDetails); die;
    	return view('admin.dashboard')->with(compact('adminDetails'));
    }
   
    public function setting()
    {
        $adminDetails=Admin::where(['username'=>Session::get('adminSession')])->first();
           // echo "<pre>"; print_r($adminDetails); die;
        return view('admin.setting')->with(compact('adminDetails'));
    }
    public function chkPassword(Request $request)
    {
        $data=$request->all();
                // /echo"<pre>"; print_r($data); die;
        
         $adminCount=Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
        if($adminCount==1){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
        
    }
    public function updatePassword(Request $request)
{
    if($request->isMethod('post')){
        $data=$request->all();
        //echo "<pre>"; print_r($data); die;
 
         $adminCount=Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
        if($adminCount==1){
            $password=md5($data['new_pwd']);
            Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
            return redirect('/admin/setting')->with('flash_success_message','Password Updated Successfully');
        }else{
            return redirect('/admin/setting')->with('flash_error_message','Incorrect Password');
        }
    
    }
}
     
     public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_success_message','Logout out Successfully');
    }
}

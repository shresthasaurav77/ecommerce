<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UsersController extends Controller
{
 
 public function userLoginRegister(){
    $meta_title="Login/Register-Ecommerce Webiste";
         
         return view('users.login_register')->with(compact('meta_title'));
    }
public function login(Request $request){
        if($request->isMethod('POST')){
            $data=$request->all();
           if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
           {
            $userStatus=User::where('email',$data['email'])->first();
            if($userStatus->status==0)
            {
              return redirect()->back()->with('flash_error_message','Your account is not actiavted !! Please Confirm your email to activate');  
            }
            Session::put('frontSession',$data['email']);
            return redirect('/cart');
           }else{
            return redirect()->back()->with('flash_error_message','Invalid Email and Password');
           }

        }
        
        }
    
public function forgot_password(Request $request){
    if($request->isMethod('post'))
    {
        $data=$request->all();
       // echo "<pre>"; print_r($data); die;
        $userCount=User::where('email',$data['email'])->count();
        if($userCount==0)
        {
            return redirect()->back()->with('flash_error_message','Sorry,Email doesnot exist');
        }
        //Getting User Details
        $userDetails=User::where('email',$data['email'])->first();
        //Generating Random Password
        $random_password=str_random(8); 
        //Encode/Secure Password
        $new_password=bcrypt($random_password); 
        //Updating Password
        User::where('email',$data['email'])->update(['password'=>$new_password]);

        //Send Forgot Password Email Code
        $email=$data['email'];
        $name=$userDetails->name;
        $messageData=['email'=>$email,'name'=>$name,'password'=>$random_password];
        Mail::send('emails.forgotpassword',$messageData,function($message)use($email){
            $message->to($email)->subject('New Password-Ecommerce Site');
        });
     return redirect('login-register')->with('flash_success_message','Your Account has been already activated .You can login Now');
    }
    

    return view('users.forgot_password');
} 
    public function register(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		//echo "<pre>";  print_r($data); die;
    $usersCount=User::where('email',$data['email'])->count();
    if($usersCount>0)
    {
        return redirect()->back()->with('flash_message_error','Email; already exists');
    }else {
        $user=new User;
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=bcrypt($data['password']);
        $user->save();
        //Send register email
        
        

        //Send Confirmation Email
        $email=$data['email'];
        $messageData=['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
         Mail::send('emails.confirmation',$messageData,function($message) use($email){
            $message->to($email)->subject('Confirm Your Email');
        });
             return redirect()->back()->with('flash_success_message','Please confirm your email to activate');


    }
    	
        }
    	

    }

    public function confirmAccount($email)
    {
        $email=base64_decode($email);
        $userCount=User::where('email',$email)->count();
        if($userCount>0){
           $userDetails=User::where('email',$email)->first();
           if($userDetails->status==1){
            return redirect('login-register')->with('flash_success_message','Your Account has been already activated .You can login Now');
           }else{
          User::where('email',$email)->update(['status'=>1]);
            //send welcome email 
           
        $messageData=['email'=>$email,'name'=>$userDetails->name];
        Mail::send('emails.welcome',$messageData,function($message) use($email){
            $message->to($email)->subject('Welcome to E-Commerce Site');
        });
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
                Session::put('frontSession',$data['email']);
            return redirect('/cart');
        }
            return redirect('login-register')->with('flash_success_message','Your Account has been already activated .You can login Now');
           }
        }else{
            abort(404);
        }
        
    }
    public function account(Request $request){
        $user_id=Auth::user()->id;
        $userDetails=User::find($user_id);
        $countries=Country::get();

        if($request->isMethod('post')){
            $data =$request->all();
            //echo "<pre>";  print_r($data); die;
            if(empty($data['name']))
            {
                return redirect()->back()->with('flash_error_message','Please Enter your name to update your account successfully');
            }
             if(empty($data['address']))
            {
               $data['address']="";
            }
             if(empty($data['state']))
            {
             $data['state']="";
            }
             if(empty($data['city']))
            {
                $data['city']="";
            }
             if(empty($data['name']))
            {
                $data['country']="";
            }
             if(empty($data['pincode']))
            {
               $data['pincode']="";

            }
             if(empty($data['mobile']))
            {
               $data['pincode']="";

            }


            $user=User::find($user_id);
            $user->name=$data['name'];
            $user->address=$data['address'];
            $user->state=$data['state'];
            $user->city=$data['city'];
            $user->country=$data['country'];
            $user->pincode=$data['pincode'];
            $user->mobile=$data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_success_message','Your Account has been Update successfully');

        }

        return view('users.account')->with(compact('countries','userDetails'));
    }

        public function chkUserPassword(Request $request)
        {
            $data=$request->all();
                //echo "<pre>"; print_r($data); die;
            $current_password=$data['current_pwd'];
            $user_id=Auth::User()->id;
            $check_password=User::where('id',$user_id)->first();
            if(Hash::check($current_password,$check_password->password))
            {
                echo "true";
            }else{
                echo "false";
            }
        }   
        public function updatePassword(Request $request){
            if($request->isMethod('post')){
                $data=$request->all();
            // echo "<pre>"; print_r($data); die;
                $old_password=User::where('id',Auth::User()->id)->first();
                $current_pwd=$data['current_pwd'];
                if(Hash::check($current_pwd,$old_password->password)){
                    $new_pwd=bcrypt($data['new_pwd']);
                    User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                    return redirect()->back()->with('flash_success_message','Your password has been updated');

                }else{
                    return redirect()->back()->with('flash_error_message','Current Password is incorrect');
                }
            }

        }
    public function logout(){

        Auth::logout();
          Session::forget('session_id');
        Session::forget('frontSession');
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        return redirect('/');
    }

    public function checkEmail(Request $request){
    	$data=$request->all();
    	$userCount=User::where('email',$data['email'])->count();
    	if($userCount>0)
    	{
    		echo "false"; 

    	}
    	else{
    		echo "true"; die;
    	}
    	}

    public function viewUsers(){
        $users=User::get();
        return view('admin.users.view_users')->with(compact('users'));
    }

}

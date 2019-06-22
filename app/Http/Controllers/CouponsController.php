<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    public function addCoupon(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		
    		$coupon=new Coupon;
    		$coupon->coupon_code=$data['coupon_code'];
    		$coupon->amount=$data['amount'];
    		$coupon->amount_type=$data['amount_type'];
    		$coupon->expiry_date=$data['expiry_date'];
    		
            if(empty($data['status']))
            {
                $data['status']=0;
            }
            $coupon->status=$data['status'];
    		$coupon->save();
    		return redirect()->action('CouponsController@viewCoupons')->with('flash_success_message','New Coupons has been  Added Succesfully');

    	}
    	return view('admin.coupons.add_coupon');
    }
   
    public function editCoupon(Request $request,$id=null)
    {
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;
    		$coupon=Coupon::find($id);
    		$coupon->coupon_code=$data['coupon_code'];
    		$coupon->amount=$data['amount'];
    		$coupon->amount_type=$data['amount_type'];
    		$coupon->expiry_date=$data['expiry_date'];
    		
            if(empty($data['status']))
            {
                $data['status']=0;
            }
            $coupon->status=$data['status'];
    		$coupon->update();
    		return redirect('admin/view-coupons')->with('flash_success_message','Coupon Has Been Edited Succesfully');

    	}
    	$couponDetails=Coupon::find($id);
    	return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }
     public function viewCoupons($id=null)
    {
    	$coupons=Coupon::get();
    	return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }
    public function deleteCoupon($id=null)
    {
    	$coupon=Coupon::find($id);
    	$coupon->delete();
    	return redirect('admin/view-coupons')->with('flash_success_message','Coupon has been Deleted Succesfully');
    }
}

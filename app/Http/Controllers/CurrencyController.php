<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    public function addCurrency(Request $request){
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;
    		$currency=new Currency;
    		$currency->currency_code=$data['currency_code'];
    		$currency->exchange_rate=$data['exchange_rate'];
    		if(empty($data['status'])){
    			$status=0;
    		}else
    		{
    			$status=1;
    		}
    		$currency->status=$status;
    		$currency->save();
    		return redirect('/admin/view-currencies')->with('flash_success_message','New Currencies has been Added Successfully');
    	}
    	return view('admin.currencies.add_currency');
    }
    public function viewCurrencies($id=null){
    	$currencies=Currency::get();
    	return view('admin.currencies.view_currencies')->with(compact('currencies'));
    }
    public function editCurrency(Request $request,$id)
    {
    	if($request->isMethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); d
    		$currency=Currency::find($id);
    	$currency->currency_code=$data['currency_code'];
    	$currency->exchange_rate=$data['exchange_rate']; 
    	if(empty($data['status'])){
    			$status=0;
    		}else
    		{
    			$status=1;
    		}
    		$currency->status=$status;
    		$currency->update();
    		return redirect('/admin/view-currencies')->with('flash_success_message','Your Curriesn Detail Has Been Updated Successfully');
    	}

			$currencyDetails=Currency::find($id);
    	return view('admin.currencies.edit_currency')->with(compact('currencyDetails'));
    }
    public function deleteCurrency($id=null)
    {
    	$currency=Currency::find($id);
    	$currency->delete();
    	return redirect('/admin/view-currencies')->with('flash_success_message','Your currencies has been deleted Successfully');
    }
}

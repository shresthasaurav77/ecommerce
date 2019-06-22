<?php

namespace App;
use DB;
use Auth;
use Session;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    public function attributes()
    {
    	return $this->hasMany('App\ProductsAttribute','product_id');
    }
    public static function cartCount(){
    	if(Auth::check())
    	{
    		//echo "User is logged in";
    		$user_email=Auth::user()->email;
    		$cartCount=DB::table('cart')->where('user_email',$user_email)->sum('quantity');
    	}else
    	{
    		$session_id=Session::get('session_id');
    		$cartCount=DB::table('cart')->where('session_id',$session_id)->sum('quantity');

    		//echo "User is not logged in";
    	}
    	return $cartCount;
    }
    public static function productCount($cat_id){
    		$catCount=Product::where(['category_id'=>$cat_id,'status'=>1])->count();
    		return $catCount;
    	
    }
    public static function  getCurrencyRates($price)
    {
        $getCurrencies=Currency::where('status',1)->get();
        foreach($getCurrencies as $currency)
        {
            if($currency->currency_code=="USD"){
                $USD_Rate=round($price/$currency->exchange_rate,2);
            }else if ($currency->currency_code=="NRS") {

            $NRS_Rate=round($price*$currency->exchange_rate,2);
            }else if($currency->currency_code=="YEN"){
                $YEN_Rate=round($price*$currency->exchange_rate,2);
            }
        }
        $currenciesArr=array('USD_Rate'=>$USD_Rate,'NRS_Rate'=>$NRS_Rate,'YEN_Rate'=>$YEN_Rate);
        return $currenciesArr;
    }
}

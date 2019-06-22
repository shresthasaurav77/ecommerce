@extends('layouts.frontendLayout.front_design')
@section('content');
<?php  
use App\Order;

?>
<?php use App\Country;?>

 
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{'/'}}">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>
			
		</div>
	</section>
	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>Your order has been placed</h3>
				<p>Your order number is {{ Session::get('order_id') }} and total payable about is INR  {{Session::get('grand_total') }}</p>
				<p>Please make payment by clicking on below Payment Button</p>
				<?php 
 							$orderDetails=Order::getOrderDetails(Session::get('order_id'));
 							$orderDetails=json_decode(json_encode($orderDetails));
 							//echo "<pre>"; print_r($orderDetails); die;
 							$nameArr=explode(' ',$orderDetails->name);
 							$getCountryCode=Order::getCountryCode($orderDetails->country);
 								?>
 					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
 							
  <!-- Saved buttons use the "secure click" command -->
  		<input type="hidden" name="cmd" value="_s-xclick">
  		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="hosted_button_id" value="221">
  		<input type="hidden" name="business" value="shresthasaurav77-facilitator@gmail.com">
  		<input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
   		<input type="hidden" name="currency_code" value="INR">
 	
 		
  		<input type="hidden" name="address1" value="{{$orderDetails->address}}">
  		<input type="hidden" name="address2" value="">
  		<input type="hidden" name="city" value="{{$orderDetails->city}}">
  		<input type="hidden" name="state" value="{{$orderDetails->state}}">
  		<input type="hidden" name="zip" value="{{$orderDetails->pincode}}">
 		<input type="hidden" name="email" value="{{$orderDetails->user_email}}">
 		<input type="hidden" name="country" value="{{$getCountryCode->country_code}}">
  
  <!-- Saved buttons display an appropriate button image. -->
  <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
  <img alt="" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
			</div>
			
		</div>
	</section>

@endsection

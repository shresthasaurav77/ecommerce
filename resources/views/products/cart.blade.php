@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{'/'}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				 @if ($message = Session::has('flash_success_message'))
    
			<div class="alert alert-success alert-block">
	    		<button type="button" class="close" data-dismiss="alert">×</button> 
	       		 <strong>{{ Session('flash_success_message') }}</strong>
			</div>
					@endif 

					@if ($message = Session::has('flash_error_message'))
    
<div class="alert alert-danger" role="alert" >
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_error_message') }}</strong>
</div>
@endif

				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userCart as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img style="width:60px;" src="{{asset('img/backend-img/products/small/'.$cart->image)}}" alt=""></a>
							</td>
							
							<td class="cart_description">
								<h4><a href="">{{$cart->product_name}}</a></h4>
								<p>{{$cart->product_code}} | {{$cart->size}}</p>
							</td>
							<td class="cart_price">
								<p>RS {{$cart->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$cart->id.'/1' ) }}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2">
									@if($cart->quantity>1)
									<a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}"> - </a>
									@endif
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rs {{$cart->price*$cart->quantity}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" title="Delete Cart Product" href="{{'/cart/delete-product/'.$cart->id}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php $total_amount=$total_amount+$cart->price*$cart->quantity ?>
						@endforeach


						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code  you want to use </p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								
								<label>Use Coupon Code</label>
								<form action="{{url('cart/apply-coupon')}}" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
               
								<input type="text" name="coupon_code">
								<input type="submit" value="Apply" class="btn btn-default">
							</li>
							
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>

							@if(!empty(Session::get('CouponAmount')))
							<li>SubTotal <span> RS <?php  echo $total_amount; ?></span></li>
							<li>Coupon Discount <span> RS <?php  echo Session::get('CouponAmount'); ?></span></li>
							<li>Grand Total <span> RS <?php  echo $total_amount-Session::get('CouponAmount'); ?></span></li>
							@else
							<li>Grand Total <span> RS <?php  echo $total_amount; ?></span></li>
							@endif
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection
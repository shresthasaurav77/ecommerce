@extends('layouts.frontendLayout.front_design')
@section('content')
 <section id="form" style="margin:20px;"><!--form-->
		<div class="container">

			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{'/'}}">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
			</div>

			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Bill Addresss</h2>
						<div class="form-group">
							{{$userDetails->name}}
						</div>
						
						<div class="form-group">
							{{$userDetails->address}}" 
						</div>
						<div class="form-group">
							{{$userDetails->city}}" 
						</div>
							<div class="form-group">
							{{$userDetails->state}}" t
						</div>
						<div class="form-group">
							{{$userDetails->country}} 
							
						</div>
						<div class="form-group">
							{{$userDetails->pincode}}
						</div>
						<div class="form-group">
							{{$userDetails->mobile}}
						</div>
						<!-- Material checked -->
					</div>
				</div>
				
				<div class="col-sm-1">
					<h2 ></h2>
				</div>
				
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>SHIP TO</h2>
						<div class="form-group">						
							{{$shippingDetails->name}}
						</div>
						<div class="form-group">						
							{{$shippingDetails->address}}
						</div>
						<div class="form-group">
						{{$shippingDetails->city}}
						</div>
						<div class="form-group">
							{{$shippingDetails->state}}
						</div>
						<div class="form-group">
							{{$shippingDetails->country}}
							
						</div>
						<div class="form-group">
							{{$shippingDetails->pincode}}
						</div>
						<div class="form-group">
							{{$shippingDetails->mobile}}
						</div>
					</div>
				</div>
							
						
				
				</div>
		</div>

		
</section>

<section id="cart_items"  style="margin:40px;">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							
						</tr>
					</thead>
					<tbody>
						<?php $total_amount=0; ?>
						@foreach($userCart as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img img style="width:70px;" src="{{asset('img/backend-img/products/small/'.$cart->image)}}"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cart->product_name}}</a></h4>
								<p>{{$cart->product_code}} | {{$cart->size}}</p>
							</td>
							<td class="cart_price">
								<p>{{$cart->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<p>{{$cart->quantity}}</p>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rs{{$cart->price*$cart->quantity}}</p>
							</td>
							
						</tr>
						<?php $total_amount=$total_amount+$cart->price*$cart->quantity ?>
						@endforeach

						
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>Rs{{$total_amount}}</td>
									</tr>
									<tr>
										<td>Discount Cost (-)</td>
										<td>@if(!empty(Session::get('CouponAmount')))
										{{Session::get('CouponAmount') }}
									@else
										0
									@endif	</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost (+)</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Grand Total</td>
										<td><span>Rs {{$grand_total=$total_amount-Session::get('CouponAmount') }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<form name="paymentForm" id="paymentForm" action="{{url('/place-order')}}" method="post" >
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="grand_total" value="{{ $grand_total }}">
				
			<div class="payment-options">
					<span>
						<label><strong>Select Payement</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"><strong>COD</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><strong>Paypal</strong></label>
					</span>
					<span style="float:right;"><button type="submit" class="btn btn-success" onclick="return selectPayementMethod();">Place a Order</span>
				</div>
		</div>
	</section>
@endsection
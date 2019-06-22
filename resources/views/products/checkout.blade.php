@extends('layouts.frontendLayout.front_design')
@section('content')
	<section id="form" style="margin:20px;"><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{'/'}}">Home</a></li>
				  <li class="active">Check Out</li>
				</ol>
			</div>
			<div class="row">
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
				<form  action="{{url('/checkout')}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Bill To</h2>
						<div class="form-group">
							<input  name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif type="text" placeholder="Billing Name" class="form-control">
						</div>
						
							<div class="form-group">
							<input  name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif  type="text" placeholder= "Billing Address" class="form-control"  />
						</div>
							<div class="form-group">
							<input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif  type="text" placeholder= "Billing City" class="form-control" />
						</div>
							<div class="form-group">
							<input  name="billing_state"  id="billing_state" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif  type="text" placeholder= "Billing State" class="form-control" />
						</div>
							<div class="form-group">
							<select name="billing_country" id="billing_country" class="form-control">
								<option value="">Select A Country</option>
								@foreach($countries as $country)
								<option value="{{$country->country_name}}" @if(!empty($userDetails->country) && $country->country_name==$userDetails->country) selected @endif>{{$country->country_name}}</option>
								@endforeach
							</select>
						</div>

							<div class="form-group">
							<input name="billing_pincode" id="billing_pincode" @if(!empty($userDetails->pincode))  value="{{$userDetails->pincode}}" @endif type="text" placeholder= "Billing pincode" class="form-control" />
						</div>
							<div class="form-group">
							<input  name="billing_mobile"  id="billing_mobile" @if(!empty($userDetails->mobile))  value="{{$userDetails->mobile}}"  @endif type="text" placeholder= "Billing Mobile" class="form-control" />
						</div>
						<!-- Material checked -->
						<div class="form-check">
  							<input type="checkbox" class="form-check-input" id="billtoship" >
  							<label class="form-check-label" for="billtoship">Billing Address  same as Shipping</label>
						</div>
							
							
					
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 ></h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>SHIP TO</h2>
						<div class="form-group">						
							<input  id="shipping_name" name="shipping_name"   @if(!empty($shippingDetails->name))   value="{{$shippingDetails->name}}" @endif type="text" placeholder="Shipping Name" class="form-control" />
						</div>
						<div class="form-group">						
							<input  id="shipping_address" name="shipping_address"  @if(!empty($shippingDetails->address))   value="{{$shippingDetails->address}}" @endif type="text" placeholder="Shipping Address" class="form-control" />
						</div>
						<div class="form-group">
							<input  id="shipping_city" name="shipping_city"  @if(!empty($shippingDetails->city))   value="{{$shippingDetails->city}}" @endif type="text" placeholder="Shipping City" class="form-control" />
						</div>
						<div class="form-group">
							<input  id="shipping_state" name="shipping_state"  @if(!empty($shippingDetails->state))   value="{{$shippingDetails->state}}" @endif type="text" placeholder="Shipping State" class="form-control" />
						</div>
						<div class="form-group">
							<select name="shipping_country" id="shipping_country" class="form-control">
								<option value="">Select A Country</option>
								@foreach($countries as $country)
								<option value="{{$country->country_name}}" @if(!empty($shippingDetails->country) && $country->country_name==$shippingDetails->country) selected @endif >{{$country->country_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input id="shipping_pincode" name="shipping_pincode"  @if(!empty($shippingDetails->pincode))   value="{{$shippingDetails->pincode}}" @endif type="text" placeholder="Shipping pincode" class="form-control" />
						</div>
						<div class="form-group">
							<input id="shipping_mobile" name="shipping_mobile"  @if(!empty($shippingDetails->mobile))   value="{{$shippingDetails->mobile}}" @endif type="text" placeholder="Shipping Mobile" class="form-control" />
						</div>
							<div class="form-group">
							<button type="submit" class="btn btn-primary">CheckOut</button>
						</div>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</form>
</div>
</div>
</section>

@endsection
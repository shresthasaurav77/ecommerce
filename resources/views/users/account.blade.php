@extends('layouts.frontendLayout.front_design')
@section('content')
<section id="form" style="margin-top: 0px;"><!--form-->
		<div class="container">
			<div class="row">
				<div class="span12">
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

				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Update Profile</h2>
					<form  id="accountForm" name="accountForm" action="{{url('/account')}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input  value="{{$userDetails->name}}" type="text"   id="name" name="name" placeholder="Name"/>
							
							<input  value="{{$userDetails->address}}" type="text" id="address" name="address" placeholder="Address"/>
							<input  value="{{$userDetails->city}}" type="text" id="city" name="city" placeholder="City"/>
							
							<input value="{{$userDetails->state}}" type="text" id="state" name="state" placeholder="state"/>
							<select id="country" name="country">
								<option value="">Select Country</option>
								@foreach($countries as $country)
								<option value="{{$country->country_name}}" @if($country->country_name==$userDetails->country) selected @endif>{{$country->country_name}}</option>
								@endforeach
							</select>

							<input style="margin-top:15px;" value="{{$userDetails->pincode}}" type="text" id="pincode" name="pincode" placeholder="Pincode"/>
							<input  value="{{$userDetails->mobile}}" type="text" name="mobile" id="mobile" placeholder="mobile"/>
							<button type="submit" class="btn btn-default">Update </button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Update Password</h2>
						<form  id="passwordForm" name="passwordForm" action="{{url('update-user-pwd')}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="password" id="current_pwd" name="current_pwd" placeholder="Current Password"/>
							<span id="chkPwd"></span>
							<input type="password" id="new_pwd" name="new_pwd" placeholder="New Password"/>
							<input type="password" id="confirm_pwd" name="confirm_pwd" placeholder=" Confirm Password"/>



							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>
@endsection
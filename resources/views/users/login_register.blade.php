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
						<h2>Login to your account</h2>
						<form id="loginForm" name="loginForm" action="{{url('/user-login')}}" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password"  name="password" placeholder="Password" />
							
							<button type="submit" class="btn btn-default">Login</button><br>
							<a href="{{url('forgot-password')}}">Forget Password ?</a>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form  id="registerForm" name="registerForm" action="{{url('/user-register')}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="text" id="name" name="name" placeholder="Name"/>
							<input type="email" id="email" name="email" placeholder="Email Address"/>
							<input type="password" id="myPassword" name="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>
@endsection
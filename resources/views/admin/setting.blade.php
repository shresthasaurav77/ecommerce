@extends('layouts.adminLayout.admin_design')
@section('title','Setting')
@section('title','Setting')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <i class="icon icon-cog"></i><a href="#" >Setting</a> </div>
    <h1>Setting</h1>
  </div>
  <div class="container-fluid"><hr>
    
   
      <div class="row-fluid">
      	  @if ($message = Session::has('flash_error_message'))
    
<div class="alert alert-error alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_error_message') }}</strong>
</div>
@endif
   @if ($message = Session::has('flash_success_message'))
    
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_success_message') }}</strong>
</div>
@endif
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Security validation</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/update-pwd')}}" name="password_validate" id="password_validate" novalidate="novalidate">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="control-group">
                  <label class="control-label">Username</label>
                  <div class="controls">
                    <p class="form-control-static" value="">{{$adminDetails->username}}</p>
                    <span id="chkPassword"></span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Current Password</label>
                  <div class="controls">
                    <input type="password" name="current_pwd" id="current_pwd" />
                    <span id="chkPassword"></span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">New password</label>
                  <div class="controls">
                    <input type="password" name="new_pwd" id="new_pwd" />
                  </div>
                </div>
                  <div class="control-group">
                  <label class="control-label">Confirm password</label>
                  <div class="controls">
                    <input type="password" name="confirm_pwd" id="confirm_pwd" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update Password" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
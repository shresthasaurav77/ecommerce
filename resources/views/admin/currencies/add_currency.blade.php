@extends('layouts.adminLayout.admin_design')
@section('title','Add Currencies')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Currencies</a> <a href="#" class="current">Add Currency</a> </div>
    <h1>Currencies</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        @if ($message = Session::has('flash_success_message'))
    
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_success_message') }}</strong>
</div>
@endif   
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Currencies</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-currency') }}" name="add_currency" id="add_currency" novalidate="novalidate">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="control-group">
                <label class="control-label">Category Code</label>
                <div class="controls">
                  <input type="text" name="currency_code" id="currency_code">
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Exchange Rate</label>
                <div class="controls">
                  <input type="text" name="exchange_rate" id="exchange_rate">
                </div>
              </div>
             
               <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
 
              <div class="form-actions">
                <input type="submit" value="Add Currency" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    </div>
  </div>

@endsection
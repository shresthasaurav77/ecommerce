@extends('layouts.adminLayout.admin_design')
@section('title','Edit Category')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Currencies</a> <a href="#" class="current">Edit Currency</a> </div>
    <h1>Categories</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Currencies</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-currency/'.$currencyDetails->id) }}" name="edit_category" id="edit_category" novalidate="novalidate">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="control-group">
                <label class="control-label">Currency Code</label>
                <div class="controls">
                  <input type="text" name="currency_code" id="currency_code" value="{{$currencyDetails->currency_code}}">
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label">Exchange Rate</label>
                <div class="controls">
                  <input type="text" name="exchange_rate" id="exchange_rate" value="{{$currencyDetails->exchange_rate}}">
                </div>
              </div>
               
            
              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input  type="checkbox" name="status" id="status" @if($currencyDetails->status=="1")checked @endif value="1" >
                </div>
              </div>
 
              <div class="form-actions">
                <input type="submit" value="Edit Currency" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    </div>
  </div>

@endsection
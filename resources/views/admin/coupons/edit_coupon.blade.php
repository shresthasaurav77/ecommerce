@extends('layouts.adminLayout.admin_design')
@section('title','Edit Product')
@section('content')
<div id="content-header">
    <div id="breadcrumb"> <a href="{{url('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">Edit Coupon</a> </div>
    <h1>Coupon</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Form validation</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_coupon/'.$couponDetails->id) }}" name="edit_coupon" id="edit_coupon" novalidate="novalidate" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">

        
              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="coupon_code" id="coupon_code" value="{{ $couponDetails->coupon_code}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" name="amount" id="amount" value="{{ $couponDetails->amount}}">
                </div>
              </div>
                    <div class="control-group">
                <label class="control-label">Amount Type</label>
                <div class="controls">
                  <select name="amount_type"  id="amount_type" style="width:220px">
                  <option  @if($couponDetails->amount_type=="percentage")selected @endif value="percentage">Percentage</option>
                <option @if($couponDetails->amount_type=="fixed")selected @endif value="fixed">Fixed</option>
              
                
                  </select>
                </div>
                 </div>
                <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="text" name="expiry_date" id="expiry_date" value="{{ $couponDetails->expiry_date}}">
                </div>
              </div>
             
              
              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input  type="checkbox" name="status" id="status" @if($couponDetails->status=="1")checked @endif value="1" >
                </div>
              </div>
               
              
 
              <div class="form-actions">
                <input type="submit" value="Edit Product" class="btn btn-success">
                <a href="{{url('/admin/view-product')}}"  class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    </div>
  </div>
@endsection
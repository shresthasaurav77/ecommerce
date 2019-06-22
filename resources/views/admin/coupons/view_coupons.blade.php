@extends('layouts.adminLayout.admin_design')
@section('title','View Coupons')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">View Coupons</a> </div>
    <h1>Coupons</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      	 @if ($message = Session::has('flash_success_message'))
    
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_success_message') }}</strong>
</div>
@endif 

@if ($message = Session::has('flash_error_message'))
    
<div class="alert alert-error alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_error_message') }}</strong>
</div>
@endif 
       
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                 <th>Coupon ID</th>
                  <th>Coupon Code</th>
                  <th>Amount</th>
                  <th>Amount Types</th>
                  <th>Expiry Date</th>
                  <th>Created At</th>
                  <th> Status</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($coupons as $coupon)
                <tr class="gradeX">
                  <td>{{$coupon->id}}</td>
                  <td>{{$coupon->coupon_code}}</td>
                  <td>{{$coupon->amount}}
                    @if($coupon->amount_type=="percentage") % @else RS @endif
                  </td>
                  
                  <td>{{$coupon->amount_type }}</td>
                  <td>{{$coupon->expiry_date}}</td> 
                  <td>{{$coupon->created_at}}</td>
                  <td>
                    @if($coupon->status=="1")Active @else Inactive @endif
                  </td>
                  <td>
                  
                    <a href="{{url('/admin/edit_coupon/'.$coupon->id)}}" class="btn btn-primary btn-mini" title="Edit  Coupon">Edit</a> <a  href="{{url('/admin/delete_coupon/'.$coupon->id)}}"  class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a></td>
                </tr> 
            
                  
                    
                    
                  
                     
            
         @endforeach
              </tbody>
               
          
         
       
          
       
        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
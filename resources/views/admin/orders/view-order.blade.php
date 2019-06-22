@extends('layouts.adminLayout.admin_design')
@section('title','View Category')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Order</a> <a href="#" class="current">View Order</a> </div>
    <h1>Orders</h1>
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
            <h5>Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                
                <tr>
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Ordered Product()</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th>Payment Method</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
           @foreach($orders as $order)
                 <tr class="gradeX">
                  <td>{{$order->id}}</td>
                  <td>{{date('M j , Y ', strtotime($order->created_at)) }}</td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->user_email}}</td>
                  <td>@foreach($order->orders as $pro)
                   {{$pro->product_code}}
                   ({{$pro->product_qty}}) </br>
                 @endforeach</td>
                  <td>Rs {{$order->grand_total}}</td>
                  <td>{{$order->order_status}}</td>
                  <td>{{$order->payment_method}}</td>
                  <td  class="center">
                    <a target="_blank"  href="{{url('/admin/view-order/'.$order->id)}}" class="btn btn-primary btn-mini" title="View All Order Details">View</a> </td>
                    @endforeach
                  

              </tbody>
               
          
         
       
          
       
        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
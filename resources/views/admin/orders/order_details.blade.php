@extends('layouts.adminLayout.admin_design')
@section('title','View Order Details')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Orders Details</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    <div class="span6">
     <div class="widget-box">
          <div class="widget-title"></i></span>
            <h5>Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
             
              <tbody>
                <tr>
                  <td class="taskDesc"></i>Orders Date</td>
                  <td class="taskStatus"><strong>{{date('M j , Y ', strtotime($orderDetails->created_at)) }}</strong></span></td>
             </tr>
                <tr>
                  <td class="taskDesc"></i> Orders Status</td>
                  <td class="taskStatus"><strong>{{$orderDetails->order_status}}</strong></span></td>
                  
                </tr>
                <tr>
                  <td class="taskDesc"></i> Shipping Charges</td>
                  <td class="taskStatus"><strong>{{$orderDetails->shipping_charges}}</strong></span></td>
                  
                </tr>
                <tr>
                  <td class="taskDesc"></i> Coupon Code</td>
                  <td class="taskStatus"><strong>{{$orderDetails->coupon_code}}</strong></span></td>
                  
                </tr>
                <tr>
                  <td class="taskDesc"></i> Orders Total</td>
                  <td class="taskStatus"><strong>{{$orderDetails->grand_total}}</strong></span></td>
                  
                </tr>
                <tr>
                  <td class="taskDesc"></i> Coupon Amount</td>
                  <td class="taskStatus"><strong>{{$orderDetails->coupon_amount}}</strong></span></td>
                  
                </tr>
                <tr>
                  <td class="taskDesc"></i> Orders Payment Method</td>
                  <td class="taskStatus"><strong>{{$orderDetails->payment_method}}</strong></span></td>
                  
                </tr>

               
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="span6">
      <div class="widget-box">
          <div class="widget-title"> </i></span>
            <h5>Customer Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
             
              <tbody>
                <tr>
                  <td class="taskDesc"></i>Customer Name</td>
                  <td class="taskStatus"><strong>{{$orderDetails->name }}</strong></span></td>
             </tr>
                <tr>
                  <td class="taskDesc"></i> Customer Email</td>
                  <td class="taskStatus"><strong>{{$orderDetails->user_email}}</strong></span></td>
                  
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
         <div class="accordion" id="collapse-group">

          <div class="accordion-group widget-box">
             @if ($message = Session::has('flash_success_message'))
    
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_success_message') }}</strong>
</div>
@endif   
            <div class="accordion-heading">
              <div class="widget-title"> 
                <h5>Update Order Status</h5>
                 </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content">
                <table width="100%">
                <form action="{{ url('admin/update-order-status') }}" method="post">
            
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                  <tr>
                    <td>
                  <select name="order_status" id="order_status"  class="control-label" required="">
                    <option value="" selected>Select</option>
                    <option value="New" @if($orderDetails->order_status=="New") selected @endif>New</option>
                    <option value="Pending"  @if($orderDetails->order_status=="Pending") selected @endif>Pending</option>
                    <option value="Cancelled"  @if($orderDetails->order_status=="Cancelled") selected @endif>Cancelled</option>
                    <option value="In Process"  @if($orderDetails->order_status=="In Process") selected @endif>In Process</option>
                    <option value="Shipped" @if($orderDetails->order_status=="Shipped") selected @endif>Shipped</option>
                    <option value="Delivered" @if($orderDetails->order_status=="Delivered") selected @endif>Delivered</option>
                    <option value="Paid" @if($orderDetails->order_status=="Paid") selected @endif>Paid</option>

                  </select>
                </td>
                  <td>
                  <input type="submit"  value="Updated Status" class="btn btn-default">
                </td>
              </tr>
                </form>
              </table>
              </div>
            </div>
          </div>
        
        </div>
        
      </div>
    </div>
    <hr>
    <div class="row-fluid">
      <div class="span6">
      <div class="widget-box">
          <div class="widget-title"> </i></span>
            <h5>Billing Address</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
             
              <tbody>
                <tr>
                  <td class="taskDesc"></i>Billing Name</td>
                  <td class="taskStatus"><strong>{{$userDetails->name}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Billing Address</td>
                  <td class="taskStatus"><strong>{{$userDetails->address}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Billing City</td>
                  <td class="taskStatus"><strong>{{$userDetails->city}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Billing State</td>
                  <td class="taskStatus"><strong>{{$userDetails->state}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Billing COuntry</td>
                  <td class="taskStatus"><strong>{{$userDetails->country}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Billing Pincode</td>
                  <td class="taskStatus"><strong>{{$userDetails->pincode}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Billing Mobile</td>
                  <td class="taskStatus"><strong>{{$userDetails->mobile}}</strong></span></td>
             </tr>
               
               
              </tbody>
            </table>
          </div>
        </div>  
      </div>
      <div class="span6">
     <div class="widget-box">
          <div class="widget-title"></i></span>
            <h5>Shipping Address</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
             
              <tbody>
                <tr>
                  <td class="taskDesc"></i>Shipping Name</td>
                  <td class="taskStatus"><strong>{{$orderDetails->name}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Shipping Address</td>
                  <td class="taskStatus"><strong>{{$orderDetails->address}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Shipping City</td>
                  <td class="taskStatus"><strong>{{$orderDetails->city}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Shipping State</td>
                  <td class="taskStatus"><strong>{{$orderDetails->state}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Shipping COuntry</td>
                  <td class="taskStatus"><strong>{{$orderDetails->country}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Shipping Pincode</td>
                  <td class="taskStatus"><strong>{{$orderDetails->pincode}}</strong></span></td>
             </tr>
               <tr>
                  <td class="taskDesc"></i>Shipping Mobile</td>
                  <td class="taskStatus"><strong>{{$orderDetails->mobile}}</strong></span></td>
             </tr>
               
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="span12">
       <div class="widget-box">
          <div class="widget-title"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Product Size</th>
                  <th>Product Color</th>
                  <th>Product Price</th>
                  <th>Product Qty</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orderDetails->orders as $pro)
                <tr class="gradeX">
                  <td>{{$pro->product_code}}</td>
                  <td>{{$pro->product_name}}</td>
                  <td>{{$pro->product_size}}</td>
                  <td>{{$pro->product_color}}</td>
                  <td>{{$pro->product_price}}</td>
                  <td>{{$pro->product_qty}}</td>
                
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
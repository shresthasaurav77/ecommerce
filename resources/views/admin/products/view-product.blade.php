@extends('layouts.adminLayout.admin_design')
@section('title','View Category')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Product</a> </div>
    <h1>Products</h1>
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
                  <th>Product ID</th>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Products Color</th>
                  <th>Product Price</th>
                  <th>Feature Item</th>
                  <th>Image</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($products as $product)
                <tr class="gradeX">
                  <td>{{$product->id}}</td>
                  <td>{{$product->category_id}}</td>
                  <td>{{$product->category_name}}</td>
                  
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td> 
                  <td>{{$product->product_color}}</td>
                  <td>{{$product->price}}</td>
                  <td>@if($product->feature_item) yes @else No @endif</td>
                  <td><img src="{{asset('/img/backend-img/products/medium/'.$product->image)}}" height="80px" width="100px"></td>
                  <td class="center"> <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a> <a href="{{url('/admin/add-attributes/'.$product->id)}}" class="btn btn-primary btn-mini" title="Add Atrributes">Add</a> <a href="{{url('/admin/add-images/'.$product->id)}}" class="btn btn-warning btn-mini" title="Add Images">Add</a> <a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-primary btn-mini" title="Edit  Products">Edit</a> <a  href="{{url('/admin/delete-product/'.$product->id)}}"  class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a></td>
                </tr> 
            
                  <div id="myModal{{$product->id}}" class="modal hide">
                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>Full Details OF {{$product->product_name}} </h3>
                      </div>
                    
                    <div class="modal-body">
                            <p> <img src="{{asset('/img/backend-img/products/small/'.$product->image)}}" height="170px" width="190px"></p>
                    s</div>
                      <div class="modal-body">
                      <p>Product ID:<b>{{$product->id}}</b></p>
                      <p>Category ID:<b>{{$product->category_id}}</b></p>
                      <p>Product Name:<b>{{$product->product_name}}</b></p>
                      <p>Product Code:<b>{{$product->product_code}}</b></p>
                      <p>Product Colour:<b>{{$product->product_color}}</b></p>
                      <p>Product Description:<b>{{$product->description}}</b></p>
                      <p>Product Price:<b>{{$product->price}}</b></p>
                    </div>
                  </div>
            
         @endforeach
              </tbody>
               
          
         
       
          
       
        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@extends('layouts.adminLayout.admin_design')
@section('title','Add product')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products Images</a> <a href="#" class="current">Add Product Images</a> </div>
    <h1>Products Images</h1>
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

@if ($message = Session::has('flash_error_message'))
    
<div class="alert alert-error alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_error_message') }}</strong>
</div>
@endif
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add product Images</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-images/'.$productDetails->id) }}" name="add_attributes" id="add_attribute"   enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="product_id" value="{{$productDetails->id}}">

         

             
              <div class="control-group">
                <label class="control-label">Product Attributes Name</label>
                
                   <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
                
              </div>
                <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
              </div>
                <div class="control-group">
                <label class="control-label">Product Colour</label>
                <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
              </div>
             
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image[]" id="image" multiple="multiple">
                </div>
              </div>
               
             
             

           
             
               
              
 
              <div class="form-actions">
                <input type="submit" value="Add Images" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
     <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Product Images</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Image ID</th>
                  
                  <th>Product ID</th>
                  <th>Images</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($productsImages as $img)
                <tr class="gradeX">
                  <td>{{$img->id}}</td>
                  <td>{{$img->product_id}}</td>
                  <td><img src="{{asset('/img/backend-img/products/small/'.$img->image)}}" height="60px" width="70px"></td>

              
                  
                  
                  
                  <td class="center"> <a href="#myModal{{$img->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a>   <a href="" class="btn btn-primary btn-mini">Edit</a> <a  rel="" rel1="delete_product"  href="{{url('/admin/delete-alt-image/'.$img->id)}}"  class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr> 
            
            
         @endforeach
              </tbody>
               
          
         
       
          
       
        
            </table>
          </div>
        </div>
  
    </div>
  </div>


       
    

@endsection
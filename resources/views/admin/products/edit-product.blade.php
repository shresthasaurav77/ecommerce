@extends('layouts.adminLayout.admin_design')
@section('title','Edit Product')
@section('content')
<div id="content-header">
    <div id="breadcrumb"> <a href="{{url('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Edit Product</a> </div>
    <h1>Products</h1>
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
            <h5>Form validation</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-product/'.$productDetails->id) }}" name="edit_product" id="edit_product" novalidate="novalidate" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">

              <div class="control-group">
                <label class="control-label">Under Category</label>
                <div class="controls">
                  <select name="category_id"  id="category_id" style="width:220px">
                  
                <?php echo $categories_dropdown ?>   
                
                  </select>
                </div>
                 </div>
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $productDetails->product_name}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Product Colour</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{ $productDetails->product_color}}">
                </div>
              </div>
             
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea  name="description" id="description" value="">{{ $productDetails->description}}</textarea> 
                </div>
              </div>
                  <div class="control-group">
                <label class="control-label">Material And Care</label>
                <div class="controls">
                  <textarea name="care" id="care" value="">{{ $productDetails->care}}</textarea> 
                </div>
              </div>


              <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{ $productDetails->price}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="current_image" value="{{$productDetails->image}}">
                  <img src="{{asset('/img/backend-img/products/small/'.$productDetails->image)}}" style="width:65px;">|<a href="{{url('/admin/delete-product-image/'.$productDetails->id)}}">DELETE</a>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Video</label>
                <div class="controls">
                 <div id="uniform-undefined">
                  <input type="file" name="video" id="video">
                  @if(!empty($productDetails->video))
                  <input type="hidden" name="current_video" value="{{$productDetails->video}}"> 
                  <a target="_blank" href="{{url('videos/'.$productDetails->video)}}">View</a>|
                  <a href="{{url('/admin/delete-product-video/'.$productDetails->id)}}">Delete</a>
                  @endif
                 </div>
                </div>
              </div>
                 <div class="control-group">
                <label class="control-label">Feauture Item </label>
                <div class="controls">
                  <input  type="checkbox" name="feature_item" id="feature_item" @if($productDetails->feature_item=="1")checked @endif value="1" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input  type="checkbox" name="status" id="status" @if($productDetails->status=="1")checked @endif value="1" >
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
@extends('layouts.adminLayout.admin_design')
@section('title','Add product')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product</a> </div>
    <h1>Products</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-product') }}" name="add_attribute" id="add_attribute" novalidate="novalidate" enctype="multipart/form-data">
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
                  <input type="text" name="product_name" id="product_name">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Product Colour</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color">
                </div>
              </div>
             
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea  name="description" id="description"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Material & Care</label>
                <div class="controls">
                  <textarea  name="care" id="care"></textarea> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                </div>
              </div>
                   <div class="control-group">
                <label class="control-label">Video</label>
                <div class="controls">
                  <input type="file" name="video" id="video">
                </div>
              </div>
                 <div class="control-group">
                <label class="control-label">Feature Items</label>
                <div class="controls">
                  <input type="checkbox" name="feature_item" id="feauture_item" value="1">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
               
              
 
              <div class="form-actions">
                <input type="submit" value="Add Product" class="btn btn-success">
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
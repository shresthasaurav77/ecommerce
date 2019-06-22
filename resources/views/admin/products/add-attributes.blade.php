@extends('layouts.adminLayout.admin_design')
@section('title','Add product')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products Attribute</a> <a href="#" class="current">Add Product Attributes</a> </div>
    <h1>Products Attribute</h1>
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
            <h5>Add product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-attributes/'.$productDetails->id) }}" name="add_attributes" id="add_attribute"   enctype="multipart/form-data">
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
                <label class="control-label"></label>
                  <div class="field_wrapper">
                         <div>
                          <input type="text" name="sku[]" id="sku" placeholder="Sku" style="width:120px;" required />
                          <input type="text" name="size[]" id="size" placeholder="Size" style="width:120px;" required />
                          <input type="text" name="price[]" id="price" placeholder="Price" style="width:120px;" required />
                          <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;" required />
                          <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                            
                         </div>
                  </div>
              </div>
             
             

           
             
               
              
 
              <div class="form-actions">
                <input type="submit" value="Add Attributes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
     <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="{{url('admin/edit-attributes/'.$productDetails->id)}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Attribute ID</th>
                  
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  
                  <th>Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($productDetails['attributes'] as $attribute)
                <tr class="gradeX">
                  <td><input type="hidden" name="idAttr[]" value="{{$attribute->id}}">{{ $attribute->id}}</td>
                  <td>{{$attribute->sku}}</td>
                  <td>{{$attribute->size}}</td>
                  <td><input type="text" name="price[]" value="{{$attribute->price}}"></td>
                  
                  <td><input type="text" name="stock[]" value="{{$attribute->stock}}"></td>
                  
                  
                  
                  <td class="center"> 
                    <input type="submit" value="Update" class="btn btn-success btn-mini">
                     <a href="" class="btn btn-primary btn-mini">Edit</a> <a  rel="" rel1="delete_product"  href="{{url('admin/delete-productattribute/'. $attribute->id)}}"  class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr> 
            
            
         @endforeach
              </tbody>
               
          
         
       
          
       
        
            </table>
          </div>
        </div>
  
    </div>
  </div>


       
    

@endsection
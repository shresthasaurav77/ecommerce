@extends('layouts.adminLayout.admin_design')
@section('title','Edit Product')
@section('content')
<div id="content-header">
    <div id="breadcrumb"> <a href="{{url('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">Edit Banner</a> </div>
    <h1>Banners</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Form validation</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-banner/'.$bannerDetails->id) }}" name="edit_banner" id="edit_banner" novalidate="novalidate" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">

               <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="current_image" value="{{$bannerDetails->image}}">
                  <img src="{{asset('/img/frontend-img/banners/'.$bannerDetails->image)}}" style="width:65px;">|<a href="{{url('/admin/delete-product-image/'.$bannerDetails->id)}}">DELETE</a>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{ $bannerDetails->title}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link" value="{{ $bannerDetails->link}}">
                </div>
              </div>
               
               <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input  type="checkbox" name="status" id="status" @if($bannerDetails->status=="1")checked @endif value="1" >
                </div>
              </div>
               
              
 
              <div class="form-actions">
                <input type="submit" value="Edit Banner" class="btn btn-success">
                <a href="{{url('/admin/view-banner')}}"  class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    </div>
  </div>
@endsection
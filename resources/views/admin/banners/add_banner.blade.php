@extends('layouts.adminLayout.admin_design')
@section('title','Add product')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">Add Banner</a> </div>
    <h1>Banners</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-banner') }}" name="add_banner" id="add_banner" novalidate="novalidate" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">

                 <div class="control-group">
                <label class="control-label">Banners Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image" >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link">
                </div>
              </div>
               
             
               <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
               
              
 
              <div class="form-actions">
                <input type="submit" value="Add Banner" class="btn btn-success">
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
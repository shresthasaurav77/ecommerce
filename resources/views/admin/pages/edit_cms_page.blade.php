@extends('layouts.adminLayout.admin_design')
@section('title','Add CMS')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">Edit CMS Pages</a> </div>
    <h1>CMS Pages</h1>
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
            <h5>Edit CMS Pages</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-cms-page/'.$cmsPage->id) }}" name="edit_cms_page" id="edit_cms_page" novalidate="novalidate" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                

             
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" value="{{$cmsPage->title}}" name="title" id="title">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea  name="description" id="description" value="">{{ $cmsPage->description}}</textarea> 
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">CMS page URL</label>
                <div class="controls">
                  <input type="text" name="url" value="{{$cmsPage->url}}" id="url">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Meta Titles</label>
                <div class="controls">
                  <input type="text" name="meta_title" value="{{$cmsPage->meta_title}}" id="meta_title">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <input type="text" name="meta_description" value="{{$cmsPage->meta_description}}" id="meta_description">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Meta Keywords</label>
                <div class="controls">
                  <input type="text" name="meta_keywords" value="{{$cmsPage->meta_keywords}}" id="meta_keywords">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input  type="checkbox" name="status" id="status" @if($cmsPage->status=="1")checked @endif value="1" >
                </div>
               
              
 
              <div class="form-actions">
                <input type="submit" value="Edit CMS Pages" class="btn btn-success">
                <a href="{{url('/admin/view-cms-pages')}}"  class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    </div>
  </div>

@endsection
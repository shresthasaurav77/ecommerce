@extends('layouts.adminLayout.admin_design')
@section('title','Edit Category')
@section('content')

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit Category</a> </div>
    <h1>Categories</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}" name="edit_category" id="edit_category" novalidate="novalidate">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{$categoryDetails->name}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                  <select name="parent_id" style="width:220px">
                    <option value="0">Main Category</option>
                    @foreach($levels as $val)
                    <option value="{{$val->id}}" @if($val->id==$categoryDetails->parent_id)selected @endif >{{$val->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <input type="text" name="description" id="description" value="{{$categoryDetails->description}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">URL </label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{$categoryDetails->url}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Titles</label>
                <div class="controls">
                  <input type="text" name="meta_title" value="{{$categoryDetails->meta_title}}" id="meta_title">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <input type="text" name="meta_description" value="{{$categoryDetails->meta_description}}" id="meta_description">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Meta Keywords</label>
                <div class="controls">
                  <input type="text" name="meta_keywords" value="{{$categoryDetails->meta_keywords}}" id="meta_keywords">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input  type="checkbox" name="status" id="status" @if($categoryDetails->status=="1")checked @endif value="1" >
                </div>
              </div>
 
              <div class="form-actions">
                <input type="submit" value="Edit Category" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    </div>
  </div>

@endsection
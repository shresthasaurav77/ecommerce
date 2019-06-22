@extends('layouts.adminLayout.admin_design')
@section('title','View Category')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">View Banner</a> </div>
    <h1>Banners</h1>
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
            <h5>Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Banner ID</th>
                  <th>Title</th>
                  <th>Link</th>
                  
                  <th>Image</th>
                  <th>Status</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($banners as $banner)
                <tr class="gradeX">
                  <td>{{$banner->id}}</td>
                  <td>{{$banner->title}}</td>
                  <td>{{$banner->link}}</td>
                  
               
                  <td>{{$banner->status}}</td>
                  <td><img src="{{asset('/img/frontend-img/banners/'.$banner->image)}}" height="80px" width="100px"></td>
                  <td class="center">   <a href="{{url('/admin/edit-banner/'.$banner->id)}}" class="btn btn-primary btn-mini" title="Edit  Banner">Edit</a> <a  href="{{url('/admin/delete-banner/'.$banner->id)}}"  class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a></td>
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
@extends('layouts.adminLayout.admin_design')
@section('title','View Category')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">View CMS Pages</a> </div>
    <h1>CMS Pages</h1>
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
                  <th>CMS  ID</th>
                  <th> Title</th>
                  <th>Description</th>
                  <th>URL</th>
                  <th>Status</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($cmsPages as $cmsPage)
                <tr class="gradeX">
                  <td>{{$cmsPage->id}}</td>
                  <td>{{$cmsPage->title}}</td>
                  <td>{{$cmsPage->description}}</td>
                  <td>{{$cmsPage->url}}</td>
                  <td>@if($cmsPage->status==1)<div class="btn btn-success">Active</div>@else<div class="btn btn-warning"> Inactive</div> @endif</td>
                  <td class="center"> <a href="#myModal{{$cmsPage->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View CMS">View</a> <a href="{{url('/admin/edit-cms-page/'.$cmsPage->id)}}" class="btn btn-primary btn-mini" title="Edit  CMS Pages">Edit</a> <a  href="{{url('/admin/delete-cms-page/'.$cmsPage->id)}}"  class="btn btn-danger btn-mini deleteRecord" title="Delete CMS">Delete</a></td>
                </tr> 
            
                  <div id="myModal{{$cmsPage->id}}" class="modal hide">
                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>Full Details OF {{$cmsPage->title}} </h3>
                      </div>
               
                      <div class="modal-body">
                      <p>CMS Pages ID: <b>{{$cmsPage->id}}</b></p>
                      <p>CMS Title: <b>{{$cmsPage->title}}</b></p>
                      <p>CMS Description: <b>{{$cmsPage->description}}</b></p>
                      <p>URL: <b>{{$cmsPage->url}}</b></p>

                      <p>Status: <b>@if($cmsPage->status==1)Active @else Inactive @endif </b></p>
                      <p>Created-At: <b>{{date('M j , Y ', strtotime($cmsPage->created_at)) }}</b></p>
                      
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
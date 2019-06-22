@extends('layouts.adminLayout.admin_design')
@section('title','View Category')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">User</a> <a href="#" class="current">View User</a> </div>
    <h1>User</h1>
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
            <h5>Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                
                <tr>
                  <th>User Id</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>City </th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Pincode</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Registered On</th>
               
                </tr>
              </thead>
              <tbody>
           @foreach($users as $user)
                 
                <tr class="gradeX">
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->city}}</td>
                  <td>{{$user->state}}</td>
                  <td>{{$user->country}}</td>
                  <td>{{$user->pincode}}</td>
                  <td>{{$user->mobile}}</td>
                  <td>@if($user->status==1)
                <a class="btn btn-success btn-mini">Active</a>
                @else <a class="btn btn-warning btn-mini">Inactive </a>
              @endif</td>
                  <td>{{date('M j , Y ', strtotime($user->created_at)) }}</td>
                  

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
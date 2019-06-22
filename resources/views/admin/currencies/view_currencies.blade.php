@extends('layouts.adminLayout.admin_design')
@section('title','View Currencies')
@section('content')

   <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Currencies</a> <a href="#" class="current">View Currencies</a> </div>
    <h1>Currencies</h1>
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
       
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Currencies</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Currency ID</th>
                  <th>Currency Code</th>
                  <th>Exchange Rate</th>
                  <th>status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($currencies as $currency)
                <tr class="gradeX">
                  <td>{{$currency->id}}</td>
                  <td>{{$currency->currency_code}}</td>
                  <td class="center">{{$currency->exchange_rate}}</td> 
                  <td>{{$currency->status}}</td>
                  <td class="center"><a href="{{url('/admin/edit-currency/' .$currency->id) }}" class="btn btn-primary btn-mini">Edit</a> <a id="delCat" href="{{url('/admin/delete-currency/'.$currency->id) }}" class="btn btn-danger btn-mini">Delete</a></td>
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
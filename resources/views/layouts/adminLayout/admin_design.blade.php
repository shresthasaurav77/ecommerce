<!DOCTYPE html>
<html lang="en">
<head>
<title>E-Commerce Admin| @yield('title')</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{asset('css/backend-css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend-css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend-css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend-css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend-css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend-css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('css/backend-css/matrix-media.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

<link href="{{asset('font-awesome/backend-font/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/backend-css/jquery.gritter.css')}}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>

<!--close-Header-part--> 


<!--top-Header-menu-->
@include('layouts.adminLayout.admin_header')
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->
@include('layouts.adminLayout.admin_sidebar')
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
 @yield('content')
</div>

<!--end-main-container-part-->

<!--Footer-part-->


@include('layouts.adminLayout.admin_footer')
<!--end-Footer-part-->
<script src="{{asset('js/backend-js/jquery.min.js')}}"></script> 
<!-- <script src="{{asset('js/backend-js/jquery.ui.custom.js')}}"></script> --> 
<script src="{{asset('js/backend-js/bootstrap.min.js')}}"></script> 
<script src="{{asset('js/backend-js/jquery.uniform.js')}}"></script> 
<script src="{{asset('js/backend-js/select2.min.js')}}"></script> 
<script src="{{asset('js/backend-js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/backend-js/matrix.tables.js')}}"></script>
<script src="{{asset('js/backend-js/jquery.validate.js')}}"></script> 
<script src="{{asset('js/backend-js/matrix.js')}}"></script> 
<script src="{{asset('js/backend-js/matrix.form_validation.js')}}"></script>
<script src="{{asset('js/backend-js/jquery.uniform.js')}}"></script>
<script src="{{asset('js/backend-js/matrix.popover.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#expiry_date" ).datepicker({
    	minDate: 0,
    	dateFormat:'yy:mm:dd'
    });
  } );
  </script>
</body>
</html>

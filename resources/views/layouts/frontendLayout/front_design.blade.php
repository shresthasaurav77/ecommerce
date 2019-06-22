<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(!empty($meta_title)) {{$meta_title}} @else Home | E-Shopper @endif</title>
    @if(!empty($meta_description))<meta name="description" content="{{$meta_description}}">@endif
    @if(!empty($meta_keywords))  <meta name="keywords" content="{{$meta_keywords}}">@endif
    <link href="{{asset('css/frontend-css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend-css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend-css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend-css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend-css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('css/frontend-css/main.css')}}" rel="stylesheet">
	<link href="{{asset('css/frontend-css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend-css/passtrength.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/frontend-css/easyzoom.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('img/frontend-img/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('img/frontend-img/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('img/frontend-img/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('img/frontend-img/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('img/frontend-img/ico/apple-touch-icon-57-precomposed.png')}}">
</head>
<body>
    @include('layouts.frontendLayout.front_header')
    

    <section>


@yield('content')




    </section>
    @include('layouts.frontendLayout.front_footer')

    

      <script src="{{asset('js/frontend-js/jquery.js')}}"></script>
    <script src="{{asset('js/frontend-js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/frontend-js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('js/frontend-js/price-range.js')}}"></script>
    <script src="{{asset('js/frontend-js/jquery.prettyPhoto.js')}}"></script>
    
    <script src="{{asset('js/frontend-js/main.js')}}"></script>
    <script src="{{asset('js/frontend-js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/frontend-js/passtrength.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script>
        $(function () {
                $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cdc015f287808b7"></script>
       @yield('script') 
  
  
</html>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{env('APP_NAME')}}</title>
	<meta name="csrf-token" content="{{csrf_token()}}"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('uploads/images/favicon.ico')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('themeAdmin/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{asset('themeAdmin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <style>
        .ql-editor .ql-align-center img {
            max-width: 80%!important;
        }
        p{
            color: black;
        }
    </style>
</head>
<body>
	<div id="app">
		<admin-main name="{{$name_admin}}" img="{{$image}}"/>
	</div>

	<script src="{{asset('js/admin.js')}}"></script> 


	<!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{asset('themeAdmin/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{asset('themeAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{asset('themeAdmin/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('themeAdmin/assets/libs/js/main-js.js')}}"></script>
    <script src="{{asset('themeAdmin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{asset('themeAdmin/assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{asset('themeAdmin/assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- chart c3 js -->
    <script src="{{asset('themeAdmin/assets/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{asset('themeAdmin/assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
    <script src="{{asset('themeAdmin/assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>


</body>
</html>
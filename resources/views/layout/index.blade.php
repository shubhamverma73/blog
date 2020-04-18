<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>{{ $data['title'] }}</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('images/shopping-cart-icon.png') }}" type="image/gif" sizes="16x16">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{URL::asset('css/open-iconic-bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/animate.css')}}">
	
	<link rel="stylesheet" href="{{URL::asset('css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/magnific-popup.css')}}">

	<link rel="stylesheet" href="{{URL::asset('css/aos.css')}}">

	<link rel="stylesheet" href="{{URL::asset('css/ionicons.min.css')}}">

	<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/jquery.timepicker.css')}}">

	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<link rel="stylesheet" href="{{URL::asset('css/flaticon.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/icomoon.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">

	<script src="{{URL::asset('js/jquery.min.js')}}"></script>
</head>
<body class="goto-here">
	<!-- END nav -->
		@include('layout.header')
		@yield('content')
		@include('layout.footer')
	</div>
</body>

</html>
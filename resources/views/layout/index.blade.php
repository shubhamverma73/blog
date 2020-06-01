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

	<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-messaging.js"></script>
	<script>
		// Your web app's Firebase configuration
		//https://github.com/damormanoj/firebase-web-push-notifications-in-php/blob/master/index.php
		// Initialize Firebase
        var config = {
			apiKey: "AIzaSyCLFQbE-OvUvsyjZprBqu7K9I8QroA8B80",
			authDomain: "web-notification-37dfe.firebaseapp.com",
			databaseURL: "https://web-notification-37dfe.firebaseio.com",
			projectId: "web-notification-37dfe",
			storageBucket: "web-notification-37dfe.appspot.com",
			messagingSenderId: "1033144298619",
			appId: "1:1033144298619:web:9120de536ae026157a86de",
			measurementId: "G-RW3E5DC3NY"
        };

        firebase.initializeApp(config);

        var messaging = firebase.messaging();

        messaging.usePublicVapidKey("BK33q1P2ujfEISNmRk_knhh-Y-iOiWA0oGpeU0SVvlNGL8iQjhGUKtrXNcuzrx4q0pctfWXI7C9rp6i1UpyJjH8");

        messaging.requestPermission().then(function() {
            console.log("ok permission");
            return messaging.getToken();
        }).then(function(token) {
            console.log("get token");
            console.log(token);
            //document.getElementById('token').innerHTML = token;
            
            /// for save token
            // $.ajax({
            //     url: 'http://localhost:53188/firebase/savetoken?token=' + token,
            //     type: "GET",
            //     crossDomain: true,
            //     data: {},
            //     success: function(res) {
            //         alert("success: " + res);
            //     },
            //     error: function(error) {
            //         alert("error: " + error);
            //     }
            // });

        }).catch(function(err) {
            console.log('Permission denied', err);
        });

        messaging.onTokenRefresh(function() {
            messaging.getToken().then(function(refreshedToken) {
                console.log('Token refreshed.');
                console.log(refreshedToken);
                // should call ajax to savetoken 
                // http://localhost:53188/firebase/savetoken?token=
            }).catch(function(err) {
                console.log('Unable to retrieve refreshed token ', err);
            });
        });

        messaging.onMessage(function(payload) {
            console.log('onMessage: ', payload);
            var message = document.getElementById('message').innerHTML;
            message = message + '<div>' + JSON.stringify(payload) + '</div>';

            document.getElementById('message').innerHTML = message;
        });
	</script>
</body>

</html>
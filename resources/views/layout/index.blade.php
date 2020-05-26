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

	<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.14.5/firebase-messaging.js"></script>
	<script>
		// Your web app's Firebase configuration
		//https://github.com/damormanoj/firebase-web-push-notifications-in-php/blob/master/index.php
		var firebaseConfig = {
			apiKey: "AIzaSyCLFQbE-OvUvsyjZprBqu7K9I8QroA8B80",
			authDomain: "web-notification-37dfe.firebaseapp.com",
			databaseURL: "https://web-notification-37dfe.firebaseio.com",
			projectId: "web-notification-37dfe",
			storageBucket: "web-notification-37dfe.appspot.com",
			messagingSenderId: "1033144298619",
			appId: "1:1033144298619:web:9120de536ae026157a86de",
			measurementId: "G-RW3E5DC3NY"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
		// Retrieve Firebase Messaging object.
		const messaging = firebase.messaging();
		// Add the public key generated from the console here.
		messaging.usePublicVapidKey("BK33q1P2ujfEISNmRk_knhh-Y-iOiWA0oGpeU0SVvlNGL8iQjhGUKtrXNcuzrx4q0pctfWXI7C9rp6i1UpyJjH8");

		Notification.requestPermission().then((permission) => {
		  if (permission === 'granted') {
			console.log('Notification permission granted.');
			// TODO(developer): Retrieve an Instance ID token for use with FCM.
			// [START_EXCLUDE]
			// In many cases once an app has been granted notification permission,
			// it should update its UI reflecting this.
			// [END_EXCLUDE]
		  } else {
			console.log('Unable to get permission to notify.');
		  }
		});

		// Get Instance ID token. Initially this makes a network call, once retrieved
		// subsequent calls to getToken will return from cache.
		messaging.getToken().then((currentToken) => {
		  if (currentToken) {
			sendTokenToServer(currentToken);
			updateUIForPushEnabled(currentToken);
		  } else {
			// Show permission request.
			console.log('No Instance ID token available. Request permission to generate one.');
			// Show permission UI.
			updateUIForPushPermissionRequired();
			setTokenSentToServer(false);
		  }
		}).catch((err) => {
		  console.log('An error occurred while retrieving token. ', err);
		  //showToken('Error retrieving Instance ID token. ', err);
		  setTokenSentToServer(false);
		});

		// Callback fired if Instance ID token is updated.
		messaging.onTokenRefresh(() => {
		  messaging.getToken().then((refreshedToken) => {
			console.log('Token refreshed.');
			// Indicate that the new Instance ID token has not yet been sent to the
			// app server.
			setTokenSentToServer(false);
			// Send Instance ID token to app server.
			sendTokenToServer(refreshedToken);
			// ...
		  }).catch((err) => {
			console.log('Unable to retrieve refreshed token ', err);
			showToken('Unable to retrieve refreshed token ', err);
		  });
		});


	  	function showToken(currentToken) {
			// Show token in console and UI.
			const tokenElement = document.querySelector('#token');
			tokenElement.textContent = currentToken;
	  	}

		function sendTokenToServer(currentToken) {
			if (!isTokenSentToServer()) {
				console.log('Sending token to server...');
				// TODO(developer): Send the current token to your server.
				setTokenSentToServer(true);
			} else {
				console.log('Token already sent to server so won\'t send it again ' + 'unless it changes');
			}
		}

		function showHideDiv(divId, show) {
		    const div = document.querySelector('#' + divId);
		    if (show) {
		      div.style = 'display: visible';
		    } else {
		      div.style = 'display: none';
		    }
  		}

		function isTokenSentToServer() {
			return window.localStorage.getItem('sentToServer') === '1';
		}

		function setTokenSentToServer(sent) {
			window.localStorage.setItem('sentToServer', sent ? '1' : '0');
		}

		// Add a message to the messages element.
		function appendMessage(payload) {
			const messagesElement = document.querySelector('#messages');
			const dataHeaderELement = document.createElement('h5');
			const dataElement = document.createElement('pre');
			dataElement.style = 'overflow-x:hidden;';
			dataHeaderELement.textContent = 'Received message:';
			dataElement.textContent = JSON.stringify(payload, null, 2);
			messagesElement.appendChild(dataHeaderELement);
			messagesElement.appendChild(dataElement);
		}

		// Clear the messages element of all children.
		function clearMessages() {
			const messagesElement = document.querySelector('#messages');
			while (messagesElement.hasChildNodes()) {
			messagesElement.removeChild(messagesElement.lastChild);
		}
		}

		function updateUIForPushEnabled(currentToken) {
			showHideDiv(tokenDivId, true);
			showHideDiv(permissionDivId, false);
			showToken(currentToken);
		}

		function updateUIForPushPermissionRequired() {
			showHideDiv(tokenDivId, false);
			showHideDiv(permissionDivId, true);
		}
	</script>
</body>

</html>
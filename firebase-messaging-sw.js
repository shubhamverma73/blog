importScripts("https://www.gstatic.com/firebasejs/7.14.5/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.14.5/firebase-messaging.js");

// Your web app's Firebase configuration
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
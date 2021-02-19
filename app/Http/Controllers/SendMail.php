<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event\UserCreated;

class SendMail extends Controller
{
	// Create Event and Lister code implemented in EventServiceProvider in app/providers/EventServiceProvider.
	// After that hit this command to create evnet and listner-: php artisan event:generate
	// Event and Listner are created in app folder.
	// Check UserCreated and SendMail class for more detail code, but ther are less code to so you may not need to much strugle.
	// https://www.youtube.com/watch?v=gWyxgmuRn2Y&ab_channel=CodeStepByStep
	function index() {
		event(new UserCreated('shubhamkrverma73@gmail.com', 'Account created successfully and confirmation mail sent to your mail id.'));
	}    
}

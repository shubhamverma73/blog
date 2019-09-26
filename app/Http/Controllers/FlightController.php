<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Flight;

class FlightController extends Controller
{
    public function index() {

		$flights = Flight::all();

		foreach ($flights as $flight) {
		    echo $flight->name.'<br>';
		}
	}
}

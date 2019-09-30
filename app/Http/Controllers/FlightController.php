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

	public function specific_record($id) {
		$flight = Flight::find($id);
		echo $flight->name;
	}

	public function where_record($id) {
		$flights = Flight::where('cat_id', '=', $id)->get();
		foreach ($flights as $flight) {
			echo $flight->name.'<br>';
		}
	}

	public function update_record($id) {
		$upArray = array(
			'short_descprition' => 'Fresh carrot description updated',
			'description' => 'Fresh carrot description updated',
	    );
	    $updateOrder = Flight::where('id', $id)->update($upArray);
	}
}

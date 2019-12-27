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
			//echo Flight::test();
			//echo $flight->name.'<br>';
		}

		$data['flights'] = $flights;
		return view('all_records',['data'=>$data]);
	}

	public function specific_record($id) {
		$flight = Flight::find($id); //It will work only for primary key id
		echo $flight->name;
	}

	public function where_record($id) {
		$flights = Flight::where('cat_id', $id)->get();
		//$flights = Flight::where('cat_id', '>', $id)->get();
		foreach ($flights as $flight) {
			echo $flight->name.'<br>';
		}
	}

	public function update_record($id) {
		$upArray = array(
			'short_descprition' => 'Fresh apple description updated.',
			'description' => 'Fresh apple description updated.',
	    );
	    $updateOrder = Flight::where('id', $id)->update($upArray);
	    return redirect('/thank-you')->with('message','Status updated.');
	}

	public function delete_record($id) {
		$flight = Flight::find(1);
		$flight->delete(); //Single record

		Flight::destroy(1); //Single record
		Flight::destroy(1, 2, 3); //Multiple records only primary key
		Flight::where('cat_id', '=', 1)->delete(); //Delete using other column value
	}

	public function thank_you() {
		$data['title'] = 'Thank You';
		return view('thank_you',['data'=>$data]);
	}
}

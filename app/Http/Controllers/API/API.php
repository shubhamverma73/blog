<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Product;

class API extends Controller
{    

	function first_api() {
		return Product::where('cat_id', 1)->get();
	}

	function save_data(Request $request) {
		$datas = json_decode($request->getContent());
		$name = $datas->name;
		$email = $datas->email;
		$password = $datas->password;
		$data=array('name'=>$name,"email"=>$email,"pass"=>$password,"date"=>date('Y-m-d'),"time"=>date('H:i:s'));
		$id = DB::table('registration')->insertGetId($data);
		if(!empty($id)) {
			exit(json_encode(array('status'=>'2', 'data'=>'', 'message'=>'data inserted successfully.')));
		} else {
			exit(json_encode(array('status'=>'2', 'data'=>'', 'message'=>'data not inserted, try again.')));
		}
	}

	function update_data(Request $request) {
		$datas = json_decode($request->getContent());
		$password = $datas->password;
		$data=array("pass"=>$password,"updated_at"=>date('Y-m-d H:i:s'));
		$id_details = DB::table('registration')->where('id', $datas->id)->update($data);
		if(!empty($id_details)) {
			exit(json_encode(array('status'=>'2', 'data'=>'', 'message'=>'data updated successfully.')));
		} else {
			exit(json_encode(array('status'=>'2', 'data'=>'', 'message'=>'data not update, try again.')));
		}
	}
}

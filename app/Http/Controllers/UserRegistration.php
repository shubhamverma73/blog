<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserRegistration extends Controller
{
	public function register() {
		$data['title'] = 'User Registration';

		return view('register',['data'=>$data]);
	}

	public function signup(Request $request) {
		$name = $request->input('name');
		$email = $request->email;
		$password = $request->password;

		$data=array('name'=>$name,"email"=>$email,"pass"=>$password,"date"=>date('Y-m-d'));
		$id = DB::table('registration')->insertGetId($data);

		return redirect('/view-records')->with('message','User added successfully');
	}

	public function login() {
		$data['title'] = 'User Login';
		
		return view('login',['data'=>$data]);
	}

	public function signin(Request $request) {
		$email = $request->input('email');
		$password = $request->password;

		$login = DB::table('registration')->where('email', [$email])->where('pass', [$password])->first();
		if(!empty($login)) {
			$cart_details = get_cart_total_qty_and_amt($login->id);
			$user_session = array(
									'user_id' 		=> $login->id,
									'user_name' 	=> $login->name,
									'email' 		=> $login->email,
									'total_qty'		=> $cart_details[0]->total_qty,
									'total_amt'		=> $cart_details[0]->total_amt,
								);

			Session::put($user_session);
			return redirect('/home');
		} else {
			return redirect('/login')->with('failed','Invalid credential, please try again!');
		}
	}

	public function view() {
		$users['title'] = 'Dashboard';
		$users['data'] = DB::select('select * from registration');
		return view('stud_view',['data'=>$users]);
	}

	public function view_edit($id){
		$users['title'] = 'User Edit';
		$users['data'] = DB::table('registration')->where('id', [$id])->first();
      	return view('stud_edit_view',['data'=>$users]);
	}

	public function edit(Request $request,$id) {
		$name = $request->input('name');
		$email = $request->email;
		$password = $request->password;

		DB::update('update registration set name = ?,email=?,pass=? where id = ?',[$name,$email,$password,$id]);

		return redirect('/view-records')->with('message','User updated successfully');
	}

	public function destroy($id) {
		DB::delete('delete from registration where id = ?',[$id]);
		return redirect('/view-records')->with('message','User deleted successfully');
	}

	public function logout() {
		session()->forget('last_id');
		session()->flush();
		return redirect('/home')->with('message','You are successfully logout!');
	}
}

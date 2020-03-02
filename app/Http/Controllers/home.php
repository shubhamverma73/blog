<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class home extends Controller
{
    public function index() {
		$data['title'] = 'Dashboard';

		return view('home',['data'=>$data]);
	}

	public function about() {
		$data['title'] = 'About Us';

		return view('about',['data'=>$data]);
	}

	public function contact() {
		$data['title'] = 'Contact Us';

		return view('contact',['data'=>$data]);
	}

	public function products($id) {
		$data['title'] = 'Products';

		$data['product'] = DB::table('product')->where('cat_id', $id)->get();
		return view('products',['data'=>$data]);
	}

	public function all_products() {
		$data['title'] = 'Products';

		$data['product'] = DB::table('product')->where('status', 'Active')->get();
		return view('all_products',['data'=>$data]);
	}

	public function wishlist() {
		$data['title'] = 'Wishlist';

		return view('wishlist',['data'=>$data]);
	}

	public function view_product() {
		$data['title'] = 'View Product';

		return view('view_product',['data'=>$data]);
	}

	public function product_details($id) {
		$data['title'] = 'Products Details';

		$data['product'] = DB::table('product')->where('id', $id)->first();
		return view('product_details',['data'=>$data]);
	}

	public function cart() {
		$data['title'] = 'Cart';

		return view('cart',['data'=>$data]);
	}

	public function checkout() {
		$data['title'] = 'Checkout';

		return view('checkout',['data'=>$data]);
	}

	public function add_to_cart(Request $request) {
		if(!empty(session('user_id'))) {
			$product_id = $request->input('product_id');
			$quantity = $request->input('quantity');
			$product_details = DB::table('product')->where('id', [$product_id])->first();
			$data = array(
							'order_id'		=> time() . mt_rand() . $product_id,
							'product_id'	=> $product_id,
							"cat_id"		=> $product_details->cat_id,
							"user_id"		=> session('user_id'),
							"quantity"		=> $quantity,
							"price"			=> $product_details->price,
							"status"		=> 'Pending',
							"date"			=> date('Y-m-d'),
							"time"			=> date('H:i:s'),
						);
			$id = DB::table('cart')->insertGetId($data);
			if(!empty($id)) {
				Session::put('last_id', $id);

				/*$user_session = array(
								'user_id' 		=> $id,
								'user_name' 	=> $login->name,
								'email' 		=> $login->email);

				Session::put($user_session);*/

				echo 'addedToCart';
			} else {
				echo 'notAddedToCart';
			}
		} else {
			echo 'userNotLogin';
		}
	}

	public function my_account() {
		$data['title'] = 'My profile';

		$data['profile'] = DB::table('registration')->where('id', session('user_id'))->first();
		return view('profile_details',['data'=>$data]);
	}
}

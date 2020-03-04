<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Product;
use App\Http\Model\Category;

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

		$data['product'] 		= DB::table('product')->where('id', $id)->first();
		$data['cart_details'] 	= DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->where('product_id', $id)->first();
		return view('product_details',['data'=>$data]);
	}

	public function cart() {
		$data['title'] = 'Cart';
		$data['cart_details'] 	= DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->get();

		$product = Product::with(['category'])->get()->toArray();
		debug($product);

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

			// ========================== Get if user have already cart ========================
			$user_cart_details 	= DB::table('cart')->where('user_id', session('user_id'))->where('status', 'Pending')->first();
			$cart_details 		= DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->get();

			// =============== If user have already cart value ===================
			if(!empty($user_cart_details)) {
				$order_id 	= $user_cart_details->order_id;

				$total_prodct_qty 	= 0;
				$total_prodct_amt 	= 0;
				foreach ($cart_details as $key => $value) {
					if($value->product_id == $product_id) {
						$total_prodct_qty = $quantity;
						$total_prodct_amt = $quantity * $product_details->price;

						//============= Update cart details value =============
						$data_details = array(							
										"qty"			=> $total_prodct_qty,
										"amount"		=> $total_prodct_amt
									);
						$id_details = DB::table('cart_details')->where('order_id', $order_id)->update($data_details);
					} else {
						//================ Insert cart details ===============
						$data_details = array(
								'order_id'		=> $order_id,
								"user_id"		=> session('user_id'),
								'product_id'	=> $product_id,
								"cat_id"		=> $product_details->cat_id,							
								"qty"			=> $quantity,
								"amount"		=> $product_details->price * $quantity,
								"status"		=> 'Pending',
								"date"			=> date('Y-m-d'),
								"time"			=> date('H:i:s'),
								"timestamp"		=> date('Y-m-d H:i:s')
							);
						$id_details = DB::table('cart_details')->insertGetId($data_details);
					}
				}

				// ========================= Update total qty and total amont =========================
				$total_qty = DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->get()->sum('qty');
				$total_amt = DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->get()->sum('amount');
				$data = array(
								"total_qty"		=> $total_qty,
								"total_amt"		=> $total_amt,
								"status"		=> 'Pending'
							);
				DB::table('cart')->where('order_id', $order_id)->update($data);				
			} else {
				$order_id = time() . mt_rand() . $product_id;
				$total_qty 	= $quantity;
				$total_amt 	= $product_details->price;

				$data = array(
								'order_id'		=> $order_id,
								"user_id"		=> session('user_id'),
								"total_qty"		=> $quantity,
								"total_amt"		=> $product_details->price * $quantity,
								"status"		=> 'Pending',
								"date"			=> date('Y-m-d'),
								"time"			=> date('H:i:s'),
							);
				$id = DB::table('cart')->insertGetId($data);

				$data_details = array(
								'order_id'		=> $order_id,
								"user_id"		=> session('user_id'),
								'product_id'	=> $product_id,
								"cat_id"		=> $product_details->cat_id,							
								"qty"			=> $quantity,
								"amount"		=> $product_details->price * $quantity,
								"status"		=> 'Pending',
								"date"			=> date('Y-m-d'),
								"time"			=> date('H:i:s'),
								"timestamp"		=> date('Y-m-d H:i:s')
							);
				$id_details = DB::table('cart_details')->insertGetId($data_details);
			}

			if(!empty($id_details)) {
				//User cart session
				$cart_session = array(
								'order_id' 		=> $order_id,
								'total_qty' 	=> $total_qty,
								'total_amt' 	=> $total_amt
							);
				Session::put($cart_session);

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

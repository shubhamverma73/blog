<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App;
use PDF;
use Mail;
use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Product;
use App\Http\Model\Category;
use App\Http\Model\Cart;
use Illuminate\Support\Facades\Schema;

class home extends Controller
{
    public function index() {
    	/*if (!Schema::hasTable('carts')) {
		    echo 'Cart table does not exist';
		} else {
			echo 'Cart table exist';
		}*/

		$data['title'] = 'Home';

		return view('home',['data'=>$data]);
	}

	public function about() {
		$data['title'] = 'About Us';

		return view('about',['data'=>$data]);
	}

	public function contact() {
		$data['title'] = 'Contact';

		return view('contact',['data'=>$data]);
	}

	public function products($id) {
		$data['title'] = 'Products';

		$data['product'] = DB::table('product')->where('cat_id', $id)->get();
		return view('products',['data'=>$data]);
	}

	public function all_products() {
		$data['title'] = 'Products';

		$data['product'] = DB::table('product')->where('status', '1')->get();
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

		//$product = Product::with(['category'])->get()->toArray();
		$cart = Cart::with(['product'])->where('status', 'Pending')->where('user_id', session('user_id'))->get()->toArray();
		$data['cart_data'] = $cart;
		//debug($cart, false);

		return view('cart',['data'=>$data]);
	}

	public function checkout() {
		$data['title'] = 'Checkout';

		return view('checkout',['data'=>$data]);
	}

	public function add_to_cart(Request $request) {
		if(!empty(session('user_id'))) {
			$product_id = $request->input('product_id');
			//$quantity = $request->input('quantity');
			$quantity = 1;

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

	public function remove_to_cart(Request $request) {
		if(!empty(session('user_id'))) {
			$product_id 	= $request->input('cart_id');

			// =============== Delete product from cart ===================
			$upArray = array(
				'status' => 'Deleted'
		    );
		    $updateOrder = Cart::where('id', $product_id)->update($upArray);

		    // ================= Get Order ID =================
		    $user_cart_details 	= DB::table('cart')->where('user_id', session('user_id'))->where('status', 'Pending')->first();
		    $order_id 	= $user_cart_details->order_id;

			$total_qty = DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->get()->sum('qty');
			$total_amt = DB::table('cart_details')->where('user_id', session('user_id'))->where('status', 'Pending')->get()->sum('amount');

			$data = array(
							"total_qty"		=> $total_qty,
							"total_amt"		=> $total_amt,
							"status"		=> 'Pending'
						);
			$update_successfully = DB::table('cart')->where('order_id', $order_id)->update($data);

			if(!empty($update_successfully)) {
				//User cart session
				$cart_session = array(
								'order_id' 		=> $order_id,
								'total_qty' 	=> $total_qty,
								'total_amt' 	=> $total_amt
							);
				Session::put($cart_session);

				echo 'removeFromCart';
			} else {
				echo 'notRemoveFromCart';
			}
		} else {
			echo 'userNotLogin';
		}
	}

	function send_notificaiton() {
		if(send_web_notification()) {
			echo 'Success';
		} else {
			echo 'Failed';
		}
	}

	function test_join() {
		//return Category::find(2)->product;	
		$cat = Category::get()->toArray();
		debug($cat, false);
		//$category = Category::with(['product'])->where('id', 1)->get()->toArray(); //Main table will be cat and 2nd is prd
		$category = Product::with(['category'])->where('id', 4)->get()->toArray(); // Main table will be prd and 2nd is cat
		debug($category);
	}

	function pdf_maker() {
		/*$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML('<h1>First pdf in laravel</h1>');
		return $pdf->stream();*/

		$data['title'] = 'First PDF in Laravel';
		/*$pdf = PDF::loadView('invoice', $data);
		return $pdf->download('invoice.pdf');*/

		return PDF::loadView('invoice', $data)->setPaper('a4', 'landscape')->setWarnings(false)->setOptions(['dpi' => 150, 'default_font' => 'serif'])->download('myfile.pdf');		
	}

	function send_mail() {
		$to_name = 'shubham';
		$to_email = 'shubham.triadweb@gmail.com';
		$data = array('name' => 'Sonu', 'body' => 'Test Body ...');
		Mail::send('mail_view', $data, function($message) use ($to_name, $to_email) {
			$message->to($to_email)
			->subject('Test Subject');
			//$message->from('sonu@gmail.com','Sonu');
		});
		if(Mail::failures()) {
			echo 'Mail not send, try again '. new Error(Mail::failures());
		} else {
			echo 'Mail sent successfully';
		}
	}

	function test_join_three_table() {
		$cat = Cart::get()->toArray();
		//debug($cat, false);
		$category = Cart::with(['product'])->with(['category'])->where('id', 2)->get()->toArray(); // Main table will be prd and 2nd is cat
		debug($category);
	}

	function add_category(Request $req) {
		//return $req->name;
		$cat = new Category;
		$cat->name = $req->name;
		$cat->status = 1;
		$cat->date = date('Y-m-d');
		$cat->time = date('H:i:s');
		$cat->created_at = date('Y-m-d H:i:s');
		$cat->save();
		Session::flash('success', 'Category added successfully');
		return redirect('add-cat');
		//return redirect('add-cat')->with('success', 'Category added successfully');
	}

	function edit_category($id) {
		$data = Category::find($id);
		return view('edit_cat', ['data' => $data]);
	}

	function update_category(Request $req) {
		$cat = Category::find($req->id);
		$cat->name = $req->name;
		$cat->updated_at = date('Y-m-d H:i:s');
		$cat->save();
		Session::flash('success', 'Category updated successfully');
		return redirect('edit-cat/'.$req->id);
		//return redirect('add-cat')->with('success', 'Category updated successfully');
	}

	function use_encrypt_for_signup() {
		$enc_pass = Crypt::encrypt('1234@sonu');
		$ins_array = ['original_pass' => '1234@sonu', 'encrypted_pass' => $enc_pass, 'created_at' => date('Y-m-d H:i:s')];
		$encrypt_decrypt_table = DB::table('encrypt_decrypt_table')->insertGetId($ins_array);
		if($encrypt_decrypt_table) {
			return 'password encrypted successfully';
		} return 'password not encrypted, try again.';
	}

	function use_decrypt_for_login() {
		$encrypt_decrypt_table = DB::table('encrypt_decrypt_table')->where('original_pass', '1234@sonu')->get();
		if(!empty($encrypt_decrypt_table[0]->id)) {
			return Crypt::decrypt($encrypt_decrypt_table[0]->encrypted_pass);
		} return 'original_pass not fount, try again.';
	}
}
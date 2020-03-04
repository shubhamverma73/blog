<?php

//============== Set json header ===============
function set_json_header(){
	header("content-type: application/json");
}

//============ ios decrypt ============
function ios_decrypt($key, $data) {
	$data = base64_decode($data);
	if(16 !== strlen($key)) $key = hash('MD5', $key, true);
	$data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
	$padding = ord($data[strlen($data) - 1]); 
	return substr($data, 0, -$padding); 
}

function numberTowords($num) { 
	$ones = array( 
	1 => "one", 
	2 => "two", 
	3 => "three", 
	4 => "four", 
	5 => "five", 
	6 => "six", 
	7 => "seven", 
	8 => "eight", 
	9 => "nine", 
	10 => "ten", 
	11 => "eleven", 
	12 => "twelve", 
	13 => "thirteen", 
	14 => "fourteen", 
	15 => "fifteen", 
	16 => "sixteen", 
	17 => "seventeen", 
	18 => "eighteen", 
	19 => "nineteen" 
	); 
	$tens = array( 
	1 => "ten",
	2 => "twenty", 
	3 => "thirty", 
	4 => "forty", 
	5 => "fifty", 
	6 => "sixty", 
	7 => "seventy", 
	8 => "eighty", 
	9 => "ninety" 
	); 
	$hundreds = array( 
	"hundred", 
	"thousand", 
	"million", 
	"billion", 
	"trillion", 
	"quadrillion" 
	); //limit t quadrillion 
	$num = number_format($num,2,".",","); 
	$num_arr = explode(".",$num); 
	$wholenum = $num_arr[0]; 
	$decnum = $num_arr[1]; 
	$whole_arr = array_reverse(explode(",",$wholenum)); 
	krsort($whole_arr); 
	$rettxt = ""; 
	foreach($whole_arr as $key => $i){ 
		if($i < 20){ 
			$rettxt .= $ones[$i]; 
		}elseif($i < 100){ 
			$rettxt .= $tens[substr($i,0,1)]; 
			$rettxt .= " ".$ones[substr($i,1,1)]; 
		}else{ 
			$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
			$rettxt .= " ".$tens[substr($i,1,1)]; 
			$rettxt .= " ".$ones[substr($i,2,1)]; 
		} 
		if($key > 0){ 
			$rettxt .= " ".$hundreds[$key]." "; 
		} 
	} 
	if($decnum > 0){ 
		$rettxt .= " and "; 
		if($decnum < 20){ 
			$rettxt .= $ones[$decnum]; 
		}elseif($decnum < 100){ 
			$rettxt .= $tens[substr($decnum,0,1)]; 
			$rettxt .= " ".$ones[substr($decnum,1,1)]; 
		} 
	} 
	return $rettxt; 
}

function get_cart_total_qty_and_amt($user_id = null) {
	$user_id = !empty($user_id) ? $user_id : session('user_id');
	$query = DB::select("select total_qty, total_amt from cart where status = 'Pending' and user_id = '".$user_id."' ");
	return $query;

	/*$query = DB::table('cart')
                ->select(`total_qty`, `total_amt`)
                ->where('status', '=', 'Pending')
                ->where('user_id', '=', session('user_id'))
    			->first();
    return $query;*/
}
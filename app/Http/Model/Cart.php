<?php
//https://stackoverflow.com/questions/29165410/how-to-join-three-table-by-laravel-eloquent-model
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Cart extends Eloquent
{
	protected 	$table 		= 'cart_details';
	protected 	$primaryKey = 'id';
	public 		$timestamps = false;
	const 		CREATED_AT 	= 'timestamp';

	public function product()
	{
		return $this->belongsTo('App\Http\Model\product', 'product_id', 'id');
	}
}

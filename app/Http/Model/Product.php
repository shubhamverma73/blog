<?php
//https://stackoverflow.com/questions/29165410/how-to-join-three-table-by-laravel-eloquent-model
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Product extends Eloquent
{
	protected 	$table 		= 'product';
	protected 	$primaryKey = 'id';
	public 		$timestamps = false;
	const 		CREATED_AT 	= 'timestamp';

	public function category()
	{
		return $this->belongsTo('App\Http\Model\Category', 'cat_id', 'id');
	}

	public function cart()
	{
		return $this->hasMany('App\Http\Model\Cart', 'cat_id', 'id');
	}
}

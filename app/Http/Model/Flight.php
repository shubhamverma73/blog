<?php
//https://stackoverflow.com/questions/29165410/how-to-join-three-table-by-laravel-eloquent-model
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Eloquent
{
	use SoftDeletes;

	protected 	$table 		= 'product';
	protected 	$primaryKey = 'id';
	public 		$timestamps = false;
	const 		CREATED_AT 	= 'timestamp';
	protected 	$dates 		= ["deleted_at"];
	protected 	$softDelete = true;

    public function category()
    {
        return $this->belongsTo('App\Http\Model\Category', 'cat_id', 'id');
    }
}

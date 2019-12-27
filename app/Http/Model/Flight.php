<?php
//https://stackoverflow.com/questions/29165410/how-to-join-three-table-by-laravel-eloquent-model
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Flight extends Eloquent
{
	protected 	$table 		= 'product';
	protected 	$primaryKey = 'id';
	public 		$timestamps = false;
	const 		CREATED_AT 	= 'timestamp';

	public function test(){
		echo "This is a test function";
	}

    public function category()
    {
        return $this->belongsTo('App\Http\Model\Category');
    }
}

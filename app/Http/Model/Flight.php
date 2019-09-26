<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
	protected $table = 'product';
	protected $primaryKey = 'id';

	public function test(){
		echo "This is a test function";
	}
}

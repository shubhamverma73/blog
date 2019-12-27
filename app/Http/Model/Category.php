<?php
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Category extends Eloquent
{
    protected 	$table 		= "category";
    protected 	$primaryKey = 'id';
	public 		$timestamps = false;
	const 		CREATED_AT 	= 'timestamp';

    public function flight()
    {
        return $this->hasMany('App\Http\Model\Flight', 'id', 'cat_id');
    }

}

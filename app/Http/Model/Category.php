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
        return $this->hasMany('App\Http\Model\Flight', 'cat_id', 'id');
    }

    public function product()
    {
        return $this->hasMany('App\Http\Model\Product', 'cat_id', 'id');
        //return $this->hasOne('App\Http\Model\Product', 'cat_id', 'id');
    }

}

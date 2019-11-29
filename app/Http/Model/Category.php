<?php
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Category extends Eloquent
{
    protected $table = "category";

    public function flight()
    {
        return $this->hasMany('App\Models\Flight');
    }

}

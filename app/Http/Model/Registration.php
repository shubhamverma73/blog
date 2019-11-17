<?php
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Registration extends Eloquent
{
    protected $table = 'registration';

    public function flight()
    {
        return $this->hasMany('App\Models\Flight');
    }

}
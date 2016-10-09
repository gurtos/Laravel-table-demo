<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
	public $timestamps = false;
	
	public function clients()
	{
		return $this->hasMany(\App\Client::class, 'id', 'city');
	}
}

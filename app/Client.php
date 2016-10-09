<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['surname', 'name', 'birthdate', 'city', 'branch'];
	public $timestamps = false;

	public function city()
	{
		return $this->belongsTo(\App\City::class, 'city', 'id');
	}
	public function branch()
	{
		return $this->belongsTo(\App\Branch::class, 'branch', 'id');
	}
}

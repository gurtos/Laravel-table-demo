<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'company'];
	public $timestamps = false;
	
	public function company()
	{
		return $this->belongsTo(\App\Company::class, 'company', 'id');
	}
}

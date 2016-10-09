<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies'; 
    protected $fillable = ['name'];
	public $timestamps = false;
	
	public function branches()
	{
		return $this->hasMany(\App\Branch::class, 'company', 'id');
	}
}

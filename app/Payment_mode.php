<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_mode extends Model
{
	public function transactions()
	{
		return $this->hasMany('App\Transaction');
	}
}

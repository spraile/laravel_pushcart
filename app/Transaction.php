<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function status()
    {
    	return $this->belongsTo('App\Status');
    }

    public function payment_mode()
    {
    	return $this->belongsTo('App\Payment_mode');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product','product_transaction')
    		->withPivot('quantity','subtotal','price');
    }
}

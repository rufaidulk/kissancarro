<?php

namespace App\Model;

use App\Model\Cart;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{	
    public function carts()
    {
    	return $this->hasMany(Cart::class);
    }
}

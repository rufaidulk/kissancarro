<?php

namespace App\Model;

use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /*===============================================================================
    |
    |   each payment is belongs to a single order
    */
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
